<?php

	session_start();
	header('Access-Control-Allow-Origin: *');
	//header('Content-Type: application/json');

	include_once '../dbconnector/Database.php';
	include_once '../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);
?>