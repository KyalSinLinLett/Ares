<?php

	session_start();

	header('Allow-Access-Control-Origin: *');
	//header('Content-Type: application/json');
	header('Allow-Access-Control-Methods: PUT');
	header('Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Content-Type, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	// Instantiate database
	$database = new Database();
	$db = $database->connect();

	// Instantiate a user object
	$user = new User($db);

	if (isset($_POST['submit'])){

		$img = $_FILES['profilepic']['name'];
		$tmp = $_FILES['profilepic']['tmp_name'];

		$code = bin2hex(random_bytes(15));
		$newimgname = $code . $img;

		$user->id = $_SESSION['id'];
		$user->profilepic = $newimgname;

		if ($newimgname){
		    move_uploaded_file($tmp, "../../images/profilepic/" . $newimgname);
		}
		
		if ($user->change_profile_pic()){
			header("location: ../../views/editprofile.php");
		} else {
			"cannot change profile pic";
		}
	}
	
	

?>