<?php 

	session_start();

	// header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Method: POST');
	// header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Header, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Comment.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//create comment instance
	$cmt = new Comment($db);

	$cmt->comment = $_POST['cmt'];
	$cmt->post_id = $_GET['post_id'];
	$cmt->posted_by = $_GET['user_id']; //id of the logged in user
	$post_owner_id = $_GET['posted_by']; // id of the owner of the post

	if ($cmt->add_comment()){
		header("location: ../../views/viewPost.php?posted_by=$post_owner_id&user_id=$cmt->posted_by&post_id=$cmt->post_id");
	} else {
		echo "comment cannot be added";
	}



?>