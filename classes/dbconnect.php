<?php


class DbConnect {
	
    private $host = "localhost";
    private $database = "vet";
    private $user = "root";
    private $pass = "";
    private $dbConnection = null;


    public function connect() {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->dbConnection = $pdo;
            return $pdo;
    }
    public function query($query){
        $result = $this->dbConnection->query($query);
        return $result;
    }
}