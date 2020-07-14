<?php 

	session_start();

	// header("Access-Control-Allow-Origin: *");
	// header("Allow-Control-Allow-Methods: POST");
	// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	if (isset($_POST['submit'])){

		$post->user_id = $_POST['user_id'];
		$post->title = $_POST['title'];
		$post->content = $_POST['content'];

		//create post
		if ($post->create_post()){
			header('location: ../../views/profile.php?user_id='.$post->user_id);
		} else {
			echo "post not created";
		}

	}

?>