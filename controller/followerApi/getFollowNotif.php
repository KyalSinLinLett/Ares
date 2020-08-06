<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/Follower.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate like object
	$follow = new Follower($db);

	//set instance values
	$follow->user_id = $_SESSION['id'];

	$res = $follow->get_follow_notif();

?>