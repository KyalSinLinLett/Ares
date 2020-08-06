<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: GET');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate like object
	$like = new Like($db);

	//set instance values
	$like->user_id = $_SESSION['id'];

	$res = $like->get_like_notif();

?>