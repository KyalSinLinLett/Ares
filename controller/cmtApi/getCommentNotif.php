<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: GET');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/Comment.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate like object
	$cmt = new Comment($db);

	//set instance values
	$cmt->user_id = $_SESSION['id'];

	$res = $cmt->get_comment_notif();

?>