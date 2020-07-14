<?php 

	// header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Method: POST');
	// header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate like object
	$like = new Like($db);

	//user_id of the post owner
	$posted_by = isset($_GET['posted_by']) ? $_GET['posted_by'] : die();

	$like->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();

	$like->user_id = $_GET['user_id']; //liking as the logged in user

	if ($like->add_like()){
		header("Location: ../../views/viewPost.php?user_id=$like->user_id&post_id=$like->post_id&posted_by=$posted_by");	
	} else {
		echo "Cannot like post. Try again.";
	}

?>
