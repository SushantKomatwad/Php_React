<?php

header("Access-Control-Allow-origin: *");
header("Access-Control-Allow-Headers: *");

include 'DbConnection.php';

$dbobj = new DbConnection();
$conn = $dbobj->connect();

try{
 $sql = "SELECT * FROM media_details";
 $stmt = $conn->query($sql);

 $mediaDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

 echo json_encode($mediaDetails);
 
}catch(PDOException $e){
  echo "Error: " . $e->getMessage();
}

?>