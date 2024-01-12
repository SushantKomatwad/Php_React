<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'DbConn.php';

$dbObj = new DbConn();
$conn = $dbObj->connect();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));

        $hashedPassword = password_hash($user->password , PASSWORD_DEFAULT);

        $sql = "INSERT INTO users_data (id,username,email,password) VALUES(null,:username , :email , :password)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$user->username);
        $stmt->bindParam(':email',$user->email);
        $stmt->bindParam(':password',$hashedPassword);


        if($stmt->execute()){
            $response = ['status' => 1, 'message' => 'Record created succesfully...'];
        }else{
            $response = ['status' => 0 ,'message' => 'Failed to create record'];
        }
        break;

       
}
