<?php 

	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//get json input
	$data = json_decode(file_get_contents("php://input"));

	//set data to post
	$post->title = $data->title;
	$post->content = $data->content;
	$post->user_id = $data->user_id;

	//create post
	if ($post->create_post()){
		echo json_encode(array("Message" => "Post is created"));
	} else {
		echo "post not created";
	}

	


 
?>