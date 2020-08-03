<?php 

	class Follower{
		//database related
		private $conn;
		private $table = "Follower";

		//follower attributes
		public $follow_id;
		public $user_id;
		public $followed_by;

		//constructor
		public function __construct($db){
			$this->conn = $db;
		}

		//function to FOLLOW
		public function follow_user(){
			//query
			$query = "INSERT INTO 
						".$this->table."
					  SET 
					  	user_id = :user_id,
					  	followed_by = :followed_by";

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//bind params
			$stmt->bindParam(':user_id', $this->user_id);
			$stmt->bindParam(':followed_by', $this->followed_by);

			//execute stmt
			if ($stmt->execute()){
				return true;
			} 

			printf("Error: %s\n", $stmt->error);
			return false;
		}

		//function to UNFOLLOW
		public function unfollow_user(){
			//query
			$query = "DELETE FROM 
							".$this->table."
					  WHERE 
					  		user_id = :user_id 
					  		and 
					  		followed_by = :followed_by";

			//stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);
			$stmt->bindParam(':followed_by', $this->followed_by);

			//execute stmt
			if ($stmt->execute()){
				return true;
			}
			
			printf("Error: %s\n", $stmt->error);
			return false;

		}

		//function to check whether followed or not
		public function follow_validate(){
			//query
			$query = "SELECT 
							count(*)
					  FROM 
					  		".$this->table."
					  WHERE 
					  		user_id = :user_id 
					  		and
					  		followed_by = :followed_by";
			
			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);
			$stmt->bindParam(':followed_by', $this->followed_by);

			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//function to get follower count
		public function get_follower_count(){
			//query 
			$query = "SELECT 
							count(followed_by)
					  FROM 
					  		".$this->table."
					  WHERE 
					  		user_id = :user_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);

			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//function to get follower list
		public function get_follower_list(){
			
			$USERTABLE = "User";

			//query 
			$query = "SELECT 
							".$this->table.".followed_by, ".$USERTABLE.".name, ".$USERTABLE.".id, ".$USERTABLE.".profilepic
					  FROM 
					  		".$this->table."
					  LEFT JOIN
					  		".$USERTABLE."
					  ON 
					  		".$this->table.".followed_by = ".$USERTABLE.".id
					  WHERE 
					  		user_id = :user_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);

			$stmt->execute();

			return $stmt;
		}

		//function to get follower list
		public function get_following_count(){
			//query 
			$query = "SELECT 
							count(user_id)
					  FROM 
					  		".$this->table."
					  WHERE 
					  		followed_by = :followed_by";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':followed_by', $this->followed_by);

			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		//function to get follower list
		public function get_following_list(){
			
			$USERTABLE = "User";	
			//query 
			$query = "SELECT 
							".$this->table.".user_id, ".$USERTABLE.".name, ".$USERTABLE.".id, ".$USERTABLE.".profilepic
					  FROM 
					  		".$this->table."
					  LEFT JOIN
					  		".$USERTABLE."
					  ON 
					  		".$this->table.".user_id = ".$USERTABLE.".id
					  WHERE 
					  		followed_by = :user_id";

			//prepare stmt
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':user_id', $this->user_id);

			$stmt->execute();

			return $stmt;
		}

		//SELECT * FROM `Post` WHERE user_id IN (SELECT user_id FROM Follower WHERE Follower.followed_by='35') ORDER BY posted_at DESC LIMIT 20 

		//function to get posts by people the logged in user follows
		public function get_posts_by_following(){
			$POSTTABLE = "Post";
			$USERTABLE = "User";
			//query
			$query = "SELECT post_id, title, content, 					posted_at, user_id, postpics, 				name, profilepic 

					  FROM ".$POSTTABLE." 

					  INNER JOIN ".$USERTABLE." 

					  ON Post.user_id = User.id

					  WHERE user_id 

					  IN 

					  (SELECT user_id 
					  		FROM ".$this->table." 
					  		WHERE ".$this->table.".followed_by = :followed_by) 

					  ORDER BY posted_at DESC LIMIT 20";

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//bind param
			$stmt->bindParam(':followed_by', $this->followed_by);

			//execute
			$stmt->execute();

			return $stmt;
		}
	}

?>