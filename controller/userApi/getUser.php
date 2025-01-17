<?php

	// session_start();
	header('Access-Control-Allow-Origin: *');
	//header('Content-Type: application/json');

	include_once '../dbconnector/Database.php';
	include_once '../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);

	//get user id
	$user->id = isset($_SESSION['id']) ? $_SESSION['id'] : die();

	//perform a get user query
	$user = $user->get_user();

	//assign values
	$name = $user['name'];
	$email = $user['email'];
	$birthday = $user['birthday'];
	$profession = $user['profession'];
	$biography = $user['biography'];
	$profilepic = $user['profilepic'];
	
?>