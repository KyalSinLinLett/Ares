<?php 

	// session_start();

	// header("Allow-Access-Control-Origin: *");
	// header("Allow-Access-Control-Methods: POST");
	// header("Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Comment.php";

	//instantiate database
	$database = new Database();
	$db = $database->connect();

	//instantiate post obj
	$cmt = new Comment($db);

	if (isset($_POST['submit'])){

		$user_id = $_REQUEST['user_id'];
		$cmt->cmt_id = $_REQUEST['cmt_id'];
		$cmt->comment = $_POST['comment'];
		$cmt->post_id = $_REQUEST['post_id'];

		//execute query - edit
		if ($cmt->edit_comment()){
			header("location: ../../views/viewPost.php?user_id=$user_id&post_id=$cmt->post_id");
		} else {
			echo "comment not edited";
		}

	}






?>