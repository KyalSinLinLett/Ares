<?php

	class User{
		//Db related 
		private $conn;
		private $table = "User";

		//user properties
		public $id;
		public $name;
		public $password;
		public $email;
		public $birthday;
		public $profession;
		public $biography;
		public $created_at;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//function to create user (C)
		public function create_user(){
			
			//query to check if there is already a usr with same email
			$email_validator_query = "SELECT email from ".$this->table." WHERE email = :email";

			//making statement
			$email_validator_stmt = $this->conn->prepare($email_validator_query);

			//bind email to query
			$email_validator_stmt->bindParam(':email', $this->email);

			//execute stmt
			$email_validator_stmt->execute();

			// assign the result array to $res
			$res = $email_validator_stmt->fetch(PDO::FETCH_ASSOC);

			// if $res is a boolean, then there is no duplicate email and the program will run as usual 
			if (gettype($res) == "boolean"){
				//create query
				$query = "INSERT INTO 
							".$this->table."
						 SET
						 	name = :name,
						 	password = :password,
						 	email = :email,
						 	birthday = :birthday,
						 	profession = :profession,
						 	biography = :biography";

				//prepare statement
				$stmt = $this->conn->prepare($query);

				// binding params
				$stmt->bindParam(':name', $this->name);
				$stmt->bindParam(':password', $this->password);
				$stmt->bindParam(':email', $this->email);
				$stmt->bindParam(':birthday', $this->birthday);
				$stmt->bindParam(':profession', $this->profession);
				$stmt->bindParam(':biography', $this->biography);

				//execute query
				if ($stmt->execute()){
					return true;
				}

				//print error if something goes wrong
				printf("Error: %s\n", $stmt->error);
				return false;
		
			} else {
				return false;
			}
			
		}

		// function to get a user (R)
		public function get_user(){
			//create query
			$query = "SELECT * from ".$this->table.' WHERE id = :id;';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//bind id
			$stmt->bindParam(':id', $this->id);

			//execute query
			$stmt->execute();
			//set the user info into $row
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			//set properties
			$this->name = $row['name'];
			$this->password = $row['password'];
			$this->email = $row['email'];
			$this->birthday = $row['birthday'];
			$this->profession = $row['profession'];
			$this->biography = $row['biography'];
			$this->created_at = $row['created_at'];

		}

		// functioon to update user details (U)
		public function update_user(){
			//create query
			$query = "
				UPDATE  
					".$this->table."
				SET 
					name = :name,
					password = :password,
					email = :email,
					birthday = :birthday,
					profession = :profession,
					biography = :biography
				WHERE
					id=:id";

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//clean data
			$this->id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();

			//bind id
			$stmt->bindParam(":id", $this->id);

			//bind data
			$stmt->bindParam(":name", $this->name);
			$stmt->bindParam(":password", $this->password);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":birthday", $this->birthday);
			$stmt->bindParam(":profession", $this->profession);
			$stmt->bindParam(":biography", $this->biography);
			

			if ($stmt->execute()){
				return true;
			} 

			//print error message
			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//method to delete user(D)
		public function delete_user(){
			//create query
			$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//clean data
			$this->id = htmlspecialchars(strip_tags($this->id));

			//bind data
			$stmt->bindParam(':id', $this->id);

			//execute query
			if($stmt->execute()){
				return true;
			}
			//print error message
			printf("Error: %s\n", $stmt->error);
			return false;

		}

		public function user_validation(){
			//create query
			$query = "SELECT email, password from ".$this->table.' WHERE email = :email;';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//bind id
			$stmt->bindParam(':email', $this->email);

			//execute query
			$stmt->execute();

			//set the user info into $row
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}


	}

?>