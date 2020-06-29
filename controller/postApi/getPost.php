<?php 

	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: GET");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//get id from json input
	$data = json_decode(file_get_contents("php://input"));

	//set the user id
	$post->user_id = $data->user_id;

	//execute
	if ($rs = $post->get_post()){
		$post_data_array = array(
			"post_id" => $rs['post_id'],
			"author" => $rs['name'],
			"title" => $rs['title'],
			"content" => $rs['content'],
			"posted_at" => $rs['posted_at']

		);

		$post_data_json = json_encode($post_data_array);

		print_r($post_data_json);
	} else {
		print_r(json_encode(array("message"=> "user or post doesn't exist")));
	}
		

		





?>