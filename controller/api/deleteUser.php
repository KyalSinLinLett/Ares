<?php

	header('Allow-Access-Control-Origin: *');
	header('Content-Type: application/json');
	header('Allow-Access-Control-Methods: DELETE');
	header('Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Content-Type, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	//Instantiate database
	$database = new Database;
	$db = $database->connect();

	//Instantiate object
	$user = new User($db);

	//set user id
	$user->id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();

	if ($user->delete_user()){
		echo json_encode(array("message"=>"user deleted"));
	} else {
		echo json_encode(array("message"=>"user not deleted"));
	}

?>