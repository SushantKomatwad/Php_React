<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'DbConn.php';

$dbObj = new DbConn();
$conn = $dbObj->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch($method){

  case "POST" :
    $user = json_decode(file_get_contents('php://input'));

    $username = $user->username;
    $password = $user->password;

    $sql = "SELECT * FROM users_data WHERE username = :username";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username' , $username);

    $stmt->execute();

    if($stmt->rowCount() > 0){
       $userData = $stmt->fetch(PDO::FETCH_ASSOC);
       $hashedPassword = $userData['password'];

       if(password_verify($password,$hashedPassword)) {
         $response = ['status' => 1 , 'message' => 'Login Successful'];
       }else {
          $response = ['status' =>0 , 'message' => 'Incorrect Password'];
       }
    }else{
      $response = ['status'=>0 , 'message' => 'Username was not found'];
    }

    echo json_encode($response);
    break;

}

?>