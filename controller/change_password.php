<?php

	session_start();

	header('Allow-Access-Control-Origin: *');
	//header('Content-Type: application/json');
	header('Allow-Access-Control-Methods: PUT');
	header('Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Content-Type, Authorization, X-Requested-With');

	include_once "../dbconnector/Database.php";
	include_once "../models/User.php";

	//Instantiate database
	$database = new Database();
	$db = $database->connect();

	//Instantiate user object 
	$user = new User($db);

	//when submit button is clicked
	if (isset($_POST['submit'])){

		//set the id of the user we want to change the password to
		$user->id = isset($_SESSION['id']) ? $_SESSION['id'] : die();

		//set the retrieved password as $res - can access hash using $res['password']
		$res = $user->get_hashed_password();

		//current password
		$hashed = $res['password'];
		
		//new details from the form
		$oldpwd = $_POST['oldpwd'];
		$newpwd = $_POST['newpwd'];
		$c_newpwd = $_POST['cnewpwd'];

		// checks if the new pwd is confirmed
		if (strcmp($newpwd, $c_newpwd) == 0){
			// checks if the current pwd matched the hashed
			if (password_verify($oldpwd, $hashed)) {

				$new_pwd_hashed = password_hash($newpwd, PASSWORD_DEFAULT);
				$user->password = $new_pwd_hashed;

				if ($user->update_password()){
					echo "Password updated.";
					include('logout.php');
				} else {
					echo "Please try again";
				}
			} else {
				echo "Password incorrect";
			}

		} else {
			echo "<p>Passwords dont match! Try again!</p>";
		}





	}


	
?>