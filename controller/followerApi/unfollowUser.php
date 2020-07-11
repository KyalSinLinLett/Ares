<?php 

	session_start();

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: DELETE');
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
	$follow->user_id;
	$follow->followed_by;

	//execute
	if ($follow->unfollow_user()){
		echo "unfollowed";
	} else {
		echo "unfollow failed";
	}

?>