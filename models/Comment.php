<?php

	class Comment{
		//db related 
		private $conn;
		private $table = "Comment";

		//comment attributes
		public $cmt_id;
		public $comment;
		public $posted_at;
		public $post_id;
		public $posted_by;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//function to add comment
		public function add_comment(){
			//query 
			$query = "INSERT INTO ".$this->table."

					  SET
					  	comment = :comment,
					  	post_id = :post_id,
					  	posted_by = :posted_by";

			//stmt
			$stmt = $this->conn->prepare($query);

			//binding params
			$stmt->bindParam(':comment', $this->comment);
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':posted_by', $this->posted_by);

			//execute
			if ($stmt->execute()){
				return true;
			}

			//print error if something goes wrong
			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//function to get comments
		public function get_comments(){
			
			$USERTABLE = "User";
			//query
			// $query = "SELECT * FROM ".$this->table." WHERE post_id = :post_id 

			// 	 ORDER BY posted_at DESC";

			$query = "SELECT * FROM ".$this->table." 

					  LEFT JOIN ".$USERTABLE." 

					  ON ".$this->table.".posted_by = ".$USERTABLE.".id 

					  WHERE ".$this->table.".post_id=:post_id 

					  ORDER BY posted_at DESC";
			
			//stmt
			$stmt = $this->conn->prepare($query);

			//bind post_id
			$stmt->bindParam(':post_id', $this->post_id);

			//execute
			$stmt->execute();

			return $stmt;
		}

		//function to delete comment
		public function delete_comment(){
			//query 
			$query = "DELETE FROM ".$this->table." 

					  WHERE cmt_id=:cmt_id and post_id=:post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':cmt_id', $this->cmt_id);
			$stmt->bindParam(':post_id', $this->post_id);

			//execute query
			if ($stmt->execute()){
				return true;
			}

			//print error
			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//function to edit comment
		public function edit_comment(){
			//query 
			$query = "UPDATE ".$this->table."

					  SET
					  	comment = :comment
					  	
					  WHERE 
					  	cmt_id = :cmt_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':comment', $this->comment);
			$stmt->bindParam(':cmt_id', $this->cmt_id);

			//execute query
			if ($stmt->execute()){
				return true;
			}

			//print error
			printf("Error: %s\n", $stmt->error);
			return false;
		}



	}

?>