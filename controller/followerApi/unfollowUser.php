<?php 

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
	$follow->user_id = $_GET['user_id'];
	$follow->followed_by = $_GET['followed_by'];

	//execute
	if ($follow->unfollow_user()){
		header('Location: ../../views/viewProfilePage.php?user_id='.$follow->user_id);
	} else {
		echo "unfollow failed";
	}

?>