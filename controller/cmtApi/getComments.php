<?php 

	header("Access-Control-Allow-Origzin: *");
	header("Access-Control-Allow-Methods: GET");
	//header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../dbconnector/Database.php";
	include_once "../models/Comment.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$cmt = new Comment($db);

	$cmt->post_id = $_GET['post_id'];

	//set the result to $rs
	$result = $cmt->get_comments();

?>