<?php  
	
	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//getting the postid
	$post->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();
	
	$user_id = $_GET['user_id'];

	//executing
	if ($post->delete_post()){
		header('location: ../../views/profile.php?user_id='.$user_id);
	} else {
		echo "post not deleted";	
	}



?>