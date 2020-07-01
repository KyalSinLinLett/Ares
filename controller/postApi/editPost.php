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


	//updating post with new information
	//1. We need to get the new information through json
	// $data = json_decode(file_get_contents("php://input"));

	//2. set the json data to post
	// $post->title = $data->title;
	// $post->content = $data->content;
	// $post->post_id = $data->post_id;

	if (isset($_POST['submit'])){

		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->post_id = $_GET['post_id'];

		//execute query - edit
		if ($post->edit_post()){
			header("location: ../../views/profile.php");
		} else {
			echo "post not edited";
		}

	}






?>