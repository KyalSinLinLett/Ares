<?php

class Database{
	//DB Params
	private $host = "localhost";
	private $db_name = "id14323272_ares";
	//private $db_name = "Ares2";
	private $username = "id14323272_root";
	//private $username = "root";
	private $password = "1wzCAcBLT|2n*mp/";
	//private $password = "root";
	private $conn;

	//DB connect
	public function connect(){
		$this->conn = null;

		try{
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password); 
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Connection Error: " . $e->getMessage();
		}

		return $this->conn;
	}
}

?>