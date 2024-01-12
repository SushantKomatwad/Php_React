<?php

class DbConnection {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "media";
    private $conn;

    public function connect(){
        try{
          $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);

          $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

          return $this->conn;

        }catch(PDOException $e){
            echo "Connection Failed: " . $e->getMessage();
            die();
        }
    }


}

?>