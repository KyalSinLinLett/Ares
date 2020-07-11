<?php 

	class Like{
		//db related
		private $conn;
		private $table = "Likes";

		//like properties
		public $like_id;
		public $post_id;
		public $user_id;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//adding like to a post based on id
		public function add_like(){
			//query 
			$query = "INSERT INTO 
						".$this->table."(post_id, user_id) 
					  VALUES(:post_id, :user_id) 
					  ";
					  
			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind params
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':user_id', $this->user_id);

			//execute stmt
			if ($stmt->execute()){
				return true;
			}

			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//getting the number of likes on a post
		public function get_likes(){
			//query 
			$query = "SELECT count(user_id)
					  FROM ".$this->table."
					  WHERE post_id = :post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind params 
			$stmt->bindParam(':post_id', $this->post_id);

			//execute statement
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//function to check if post is already liked by user or not
		public function check_liked(){
			//query
			$query = "SELECT count(*) FROM ".$this->table." WHERE post_id = :post_id and user_id = :user_id";

			//prepate stmt
			$stmt = $this->conn->prepare($query);

			//bind params to stmt
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':user_id', $this->user_id);

			//execute stmt
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//function to unlike a post
		public function unlike(){
			//query 
			$query = "DELETE FROM ".$this->table." WHERE post_id=:post_id and user_id=:user_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind params
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':user_id', $this->user_id);

			//execute stmt
			if ($stmt->execute()){
				return true;	
			}

			printf("Error: %s\n", $stmt->error);
			return false;
		}


	}


?>

