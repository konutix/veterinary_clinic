<?php


class DbConnect {
	
	private $host = "localhost";
	private $database = "vet";
	private $user = "root";
	private $pass = "";
	
	
	public function connect() {
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
		$pdo = new PDO($dsn, $this->user, $this->pass);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	}
	
}