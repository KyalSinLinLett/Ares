<?php 

	class Post{
		//Db related attributes
		private $conn;
		private $table = "Post";
	
		//post attributes
		public $post_id;
		public $title;
		public $content;
		public $user_id;
		public $posted_at;
		public $postpics;

		// constructor
		public function __construct($db){
			$this->conn = $db;
		}

		// function to create post
		public function create_post(){

			//query 
			$query = "INSERT INTO ".$this->table."

					  SET
					  	title = :title, 
					  	content = :content,
					  	user_id = :user_id,
					  	postpics = :postpics";

			//prepared statements
			$stmt = $this->conn->prepare($query);

			//binding params
			$stmt->bindParam(':title', $this->title);
			$stmt->bindParam(':content', $this->content);
			$stmt->bindParam(':user_id', $this->user_id);
			$stmt->bindParam(':postpics', $this->postpics);
			
			// execute query
			if ($stmt->execute()){
				return true;
			}

			//print error if something goes wrong
			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//function to edit post
		public function edit_post(){
			//query 
			$query = "UPDATE ".$this->table."

					SET
						title = :title,
						content = :content

					WHERE
					    post_id = :post_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//binding params
			$stmt->bindParam(':title', $this->title);
			$stmt->bindParam(':content', $this->content);
			$stmt->bindParam(':post_id', $this->post_id);

			if ($stmt->execute()){
				return true;
			} 

			//print error message
			printf("Error: %s\n", $stmt->error);
			return false;

		}

		//function to get a post
		public function get_post(){

			$USERTABLE = "User";

			//create query
			$query = "SELECT 
						".$this->table.".post_id, ".$this->table.".title, ".$this->table.".content, ".$this->table.".posted_at, ".$this->table.".user_id, ".$this->table.".postpics, ".$USERTABLE.".name

					  FROM 
					  	".$this->table."

					  LEFT JOIN 
					  	".$USERTABLE."

					  ON
					  	".$this->table.".user_id = ".$USERTABLE.".id

					  WHERE
					  	".$this->table.".post_id = :post_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind post_id
			$stmt->bindParam(':post_id', $this->post_id);

			//execute query
			$stmt->execute();

			//set the query results to $row
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;

		}

		//function to delete post
		public function delete_post(){
			//create query
			$query = "DELETE FROM 
						".$this->table." 

					  WHERE 
					  	post_id = :post_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//binding the post id
			$stmt->bindParam(':post_id', $this->post_id);

			//execute stmt
			if ($stmt->execute()){
				return true;
			}

			//print error message
			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//function to get all posts
		public function get_all_posts(){
			//query
			$query = "SELECT * FROM ".$this->table." 

					  WHERE user_id = :user_id 

					  ORDER BY ".$this->table.".posted_at DESC";

			//create stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);
			
			//execute stmt
			$stmt->execute();

			return $stmt;
		}

		//function to get all posts
		public function get_all_posts_NF(){
			$USERTABLE = "User";
			//query
			$query = "

			SELECT 
				".$this->table.".post_id, ".$this->table.".title, ".$this->table.".content, ".$this->table.".posted_at, ".$this->table.".postpics, ".$USERTABLE.".name, ".$USERTABLE.".id, ".$USERTABLE.".profilepic 

			FROM ".$this->table." 

			LEFT JOIN ".$USERTABLE."

			ON ".$this->table.".user_id = ".$USERTABLE.".id

			ORDER BY ".$this->table.".posted_at DESC

			LIMIT 25";

			//create stmt
			$stmt = $this->conn->prepare($query);

			//execute stmt
			$stmt->execute();

			return $stmt;
		}		

		public function get_content(){
			//query
			$query = "SELECT content, postpics FROM ".$this->table." WHERE post_id = :post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':post_id', $this->post_id);

			//execute
			$stmt->execute();

			return $stmt;

		}

		public function remove_pic(){
			//query
			$query = "UPDATE ".$this->table." SET postpics = null WHERE post_id = :post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':post_id', $this->post_id);

			//execute
			$stmt->execute();

			return $stmt;

		}

		public function add_pic(){
			//query
			$query = "UPDATE ".$this->table." SET postpics = :postpics WHERE post_id = :post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':postpics', $this->postpics);

			//execute
			$stmt->execute();

			return $stmt;

		}

		public function change_pic(){
			//query
			$query = "UPDATE ".$this->table." SET postpics = :postpics WHERE post_id = :post_id";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':post_id', $this->post_id);
			$stmt->bindParam(':postpics', $this->postpics);

			//execute
			$stmt->execute();

			return $stmt;

		}


	}

?>