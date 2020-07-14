<?php
	
	session_start();

	include_once '../dbconnector/Database.php';
	include_once '../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);

	//setting the user obj email attribute as the email from the form to begin the query
	$user->email = $_POST['email'];

	//to make sure that the user wont have to login again or return back to the login page unless they've logged out.

	//$flag = false;

	//if the submit button is clicked
	if (isset($_POST['submit'])){

		//gets the returns array result set from the FETCH_ASSOC based on the email given
		$result = $user->user_validation();
		
		//ensures that the result is not an empty - boolean datatype cause if empty, the datatype of the result set is a boolean value of 0 or 1. If not checked, there will be warnings. We only want to assign the values into $email_from_db and $pwd_from_db if and only if the result is not null for one or both.
		if (gettype($result) != "boolean"){

			$email_from_db = $result['email'];
			$pwd_from_db = $result['password'];

			//values passed along to session in order to keep state.
			$_SESSION['id'] = $result['id'];			

			//the first condition check is the email we retrieved from the db matches the one in our form. Its redundant, I know, but in this case, this is completely foolproof. 

			//the second one verifies the password from the form and the hashed password we have retrieved from the database. Since it is hashed, there is no way of even the admins knowing the user's passwords because its all gibberish.

			if (strcmp($email_from_db, $user->email) == 0){
				if (password_verify($_POST['password'], $pwd_from_db)){
					header("location: ../views/profile.php?user_id=".$result['id']);	
				} else {
					echo "<p>Invalid email, password or user doesn't exist. Try again!</p>";
					session_destroy();
				}
			} else {
				echo "<p>Invalid email, password or user doesn't exist. Try again!</p>";
				session_destroy();
			}		
		} else {
			echo "<p>Invalid email, password or user doesn't exist. Try again!</p>";
			session_destroy();
		}


			
	}
		
?>