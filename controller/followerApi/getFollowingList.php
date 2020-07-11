<?php 

	session_start();

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: GET');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Header, Authorization, X-Requested-With');

	//import db and follower class
	include_once "../../dbconnector/Database.php";
	include_once "../../models/Follower.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate follower object
	$follow = new Follower($db);

	//assign values 
	$follow->followed_by;

	//execute
	if ($res = $follow->get_following_list()){
		$following_info = $res;
	} else {
		echo "cannot fetch following count";
	}

?>