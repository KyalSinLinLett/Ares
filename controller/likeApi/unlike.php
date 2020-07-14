<?php 

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$like = new Like($db);

	//user_id of the post owner
	$posted_by = isset($_GET['posted_by']) ? $_GET['posted_by'] : die();

	$like->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
	
	$like->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();
	
	if ($like->unlike()){
		echo "post unliked";
		header("Location: ../../views/viewPost.php?posted_by=$posted_by&user_id=$like->user_id&post_id=$like->post_id");
	} else {
		echo "Cannot get post likes. Try again.";
	}

?>