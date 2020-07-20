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

	//set the result to $rs
	$result = $post->get_all_posts_NF();

?>