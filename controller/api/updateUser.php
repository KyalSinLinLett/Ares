<?php

	header('Allow-Access-Control-Origin: *');
	header('Content-Type: application/json');
	header('Allow-Access-Control-Methods: PUT');
	header('Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Content-Type, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	// Instantiate database
	$database = new Database();
	$db = $database->connect();

	// Instantiate a user object
	$user = new User($db);

	//get raw data
	$data = json_decode(file_get_contents("php://input"));

	//get user id
	$user->id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();

	//updated details set to the user attributes
	$user->name = $data->name;
	$user->email = $data->email;
	$user->birthday = $data->birthday;
	$user->profession = $data->profession;
	$user->biography = $data->biography;

	if ($user->delete_user()){
		echo json_encode(array("message"=>"user updated"));
	} else {
		echo json_encode(array("message"=>"user not updated"));
	}
	

?>