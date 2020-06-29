<?php 

	session_start();

	header("Allow-Access-Control-Origin: *");
	header("Allow-Access-Control-Methods: PUT");
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
	$data = json_decode(file_get_contents("php://input"));

	//2. set the json data to post
	$post->title = $data->title;
	$post->content = $data->content;
	$post->post_id = $data->post_id;

	//execute query - edit
	if ($post->edit_post()){
		echo json_encode(array("Message" => "Post is edited"));
	} else {
		echo "post not edited";
	}



?>