<?php

	class Search{
		//db related stuff
		private $conn;
		private $userTable = "User";
		private $postTable = "Post";

		//search attribute
		public $s_query;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//function to search
		public function search_post(){
			//query 
			$query = "SELECT * FROM ".$this->postTable." WHERE title LIKE '%".$this->s_query."%'";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			// //bind param
			// $stmt->bindParam(1, $this->s_query);

			//execute
			$stmt->execute();

			return $stmt;
		}

		//function to search
		public function search_user(){
			//query 
			$query = "SELECT * FROM ".$this->userTable." WHERE name LIKE '%".$this->s_query."%'";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			// //bind param
			// $stmt->bindParam(1, );

			//execute
			$stmt->execute();

			return $stmt;
		}


	}

?>