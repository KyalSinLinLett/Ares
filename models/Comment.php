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

		public $user_id;

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

		//SELECT Comment.comment, Comment.posted_at, Comment.post_id, Comment.posted_by, User.name FROM `Comment` INNER JOIN User ON Comment.posted_by = User.id WHERE Comment.post_id IN (SELECT Post.post_id FROM Post WHERE Post.user_id = 35) ORDER BY Comment.posted_at DESC LIMIT 50 

		//function to get comment notif
		public function get_comment_notif(){
			//query 
			$query = "SELECT 
							".$this->table.".comment AS COMMENT, 
							".$this->table.".posted_at AS TIME_COMMENTED, 
							".$this->table.".post_id AS POST_ID, 
							".$this->table.".posted_by AS COMMENTER_ID, 
							User.name AS COMMENTER_NAME,
							Post.title AS TITLE 

					  FROM 
					  		".$this->table." 
					  INNER JOIN 
					  		User 
					  ON 
					  		".$this->table.".posted_by = User.id
					  LEFT JOIN
					  		Post
					  ON
					  		".$this->table.".post_id = Post.post_id 
					  WHERE 
					  		".$this->table.".post_id 
					  IN 
					  		(SELECT 
					  			Post.post_id 
					  		 FROM 
					  		 	Post 
					  		 WHERE 
					  		 	Post.user_id = :user_id) 
					  ORDER BY 
					  		".$this->table.".posted_at DESC 
					  LIMIT 50";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);

			$stmt->execute();

			return $stmt;

		}



	}

?>