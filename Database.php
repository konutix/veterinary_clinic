<?php
class Database{
    private $dbConnection = null;
    public function connect(){
        $conn = mysqli_connect("localhost", "root","", "vet");
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $this->dbConnection = $conn;
        }
    }
    public function query($query){
        $result = mysqli_query($this->dbConnection,$query);
        if($result == TRUE){
            return $result;
        }
    }
    public function close(){
        mysqli_close($this->dbConnection);
    }
}
