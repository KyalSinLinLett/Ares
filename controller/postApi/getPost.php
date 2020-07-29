<?php 

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: GET");
	//header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../dbconnector/Database.php";
	include_once "../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//set the post id
	$post->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();

	//execute
	if ($rs = $post->get_post()){
		$post_data = array(
			"post_id" => $rs['post_id'],
			"author" => $rs['name'],
			"title" => $rs['title'],
			"content" => $rs['content'],
			"posted_at" => $rs['posted_at'],
			"posted_by" => $rs['user_id'],
			"postpics" => $rs['postpics']
		);

	} else {
		echo "Unable to get post";
		header('location: ../../views/newsfeed.php');
	}


?>