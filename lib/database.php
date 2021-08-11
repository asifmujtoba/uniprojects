<?php

class Database {

	private $hostname = "fdb18.awardspace.net";
	private $username = "2680182_wpress40c909b4";
	private $password = "bqRD964h3shQYEuJfP0pVPhzfaO6ruAj";
	private $bd_name = "2680182_wpress40c909b4";
	public $conn;

	public function __construct(){
		if (!isset($this->conn)) {
			try {
				$sql = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->bd_name, $this->username, $this->password);
				$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql->exec("SET CHARACTER SET utf8");
				$this->conn = $sql;
			} catch (PDOException $e) {
				die("Faied to connection with Database!".$e->getMessage());
			}
		}
	}

}

?>