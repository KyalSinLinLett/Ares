<?php  
	
	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//getting the postid
	$post->post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die();

	//executing
	if ($post->delete_post()){
		print_r(json_encode(array("Message"=>"Post is deleted")));
	} else {
		print_r(json_encode(array("Message"=>"Post not deleted")));	
	}



?>