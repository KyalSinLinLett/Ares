<?php 

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: GET');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Method, Access-Control-Allow-Headers, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/Like.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$like = new Like($db);
?>