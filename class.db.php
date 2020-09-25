<?php
class DB{

private $DB_HOST = "localhost";

private $DB_USER = "root";

private $DB_PASSWORD = "";

private $DB_DATABASE = "airqo";

private $connection;

public function dbConnection(){
$this->connection = null;      
try{
$this->connection = new PDO('mysql:dbhost='.$this->DB_HOST.';dbname='.$this->DB_DATABASE, $this->DB_USER, $this->DB_PASSWORD);
$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
echo "CONNECTION FAILED: ".$e->getMessage();
}
return $this->connection;
}
}
?>