<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Header, Authorization, X-Requested-With');

	//import db and follower class
	include_once "../dbconnector/Database.php";
	include_once "../models/Follower.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate follower object
	$follow = new Follower($db);

	$follow->followed_by = $_SESSION['id'];

	$res = $follow->get_posts_by_following();

	$num_rows = $res->rowCount();
?>