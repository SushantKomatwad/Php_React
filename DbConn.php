<?php

 class DbConn{

    private $server = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'users';
    private $conn;

    public function connect(){
        try{
        $this->conn = new PDO("mysql:host={$this->server};dbname={$this->dbname}",$this->user,$this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connection Succesfull...!";
        return $this->conn;
        }catch(PDOException $e){
           echo "Connection Failed: " . $e->getMessage();
        }
    }

 }

?>