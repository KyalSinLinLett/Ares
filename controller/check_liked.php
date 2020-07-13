<?php 

	// header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Method: GET');
	// header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$like = new Like($db);

	$like->user_id = isset($_SESSION['id']) ? $_SESSION['id'] : die();

	$like->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();

	if ($state = $like->check_liked()){
		$condition = $state['count(*)'];
		// echo $condition;
	} else {
		echo "Cannot get post likes. Try again.";
	}

?>