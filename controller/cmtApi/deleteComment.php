<?php  
	
	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Comment.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//create comment instance
	$cmt = new Comment($db);

	$cmt->cmt_id = $_GET['cmt_id'];
	$cmt->post_id = $_GET['post_id'];
	$user_id = $_GET['user_id'];

	if ($cmt->delete_comment()){
		header("location: ../../views/viewPost.php?user_id=$user_id&post_id=$cmt->post_id");
	} else {
		echo "comment cannot be added";
	}


?>