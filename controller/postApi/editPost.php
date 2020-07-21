<?php 

	session_start();

	header("Allow-Access-Control-Origin: *");
	header("Allow-Access-Control-Methods: post");
	header("Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate database
	$database = new Database();
	$db = $database->connect();

	//instantiate post obj
	$post = new Post($db);

	if (isset($_POST['submit'])){

		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->post_id = $_GET['post_id'];

		//execute query - edit
		if ($post->edit_post()){
			header("location: ../../views/viewPost.php?user_id=".$_SESSION['id']."&post_id=".$post->post_id);
		} else {
			echo "post not edited";
		}

	}






?>