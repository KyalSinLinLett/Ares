<?php 

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$like = new Like($db);

	//user_id of the post owner
	$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

	$like->user_id = isset($_GET['id']) ? $_GET['id'] : die();
	
	$like->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();
	
	if ($like->unlike()){
		echo "post unliked";
		header("Location: ../../views/viewPost.php?user_id=$user_id&post_id=$like->post_id");
	} else {
		echo "Cannot get post likes. Try again.";
	}

?>