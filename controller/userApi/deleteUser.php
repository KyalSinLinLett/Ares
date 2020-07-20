<?php

	session_start();

	header('Allow-Access-Control-Origin: *');
	//header('Content-Type: application/json');
	header('Allow-Access-Control-Methods: DELETE');
	header('Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Content-Type, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	//Instantiate database
	$database = new Database;
	$db = $database->connect();

	//Instantiate object
	$user = new User($db);

	if (isset($_POST['submit'])){

		//set user id
		$user->id = isset($_SESSION['id']) ? $_SESSION['id'] : die();

		//set user email
		$user->email = isset($_SESSION['email']) ? $_SESSION['email'] : die();

		//getting the current user password for validation
		$pwd_res = $user->get_hashed_password();

		//setting the hashed pwd variable
		$hashed_pwd = $pwd_res['password'];

		//details form the validation form
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		$cpwd = $_POST['cpassword'];

		//check if the email submitted is the same as the one kept in session during login validation. Makes sure that u can only delete account when logged in.
		if (strcmp($email, $user->email) == 0){
			// now we check if the pwd submitted is the same as the confirmed one 
			if (strcmp($pwd, $cpwd) == 0){
				//now we make sure the password submitted is the same as the hashed we retrieved with the get_hashed_password()
				if (password_verify($pwd, $hashed_pwd)){
					//sets the final param for the delete query
					$user->password = $hashed_pwd;

					if ($user->delete_account()){
						echo "Account is deleted!";
						session_destroy();
						header("location: ../../views/signup.php");
					} else {
						echo "Account cannot be deleted.
						<a href='../../views/deleteaccount.php'> Try again..</a>";
					}

				} else { echo "pass verify problem"; echo "Account cannot be deleted.
						<a href='../../views/deleteaccount.php'> Try again..</a>";}

			} else {echo "password problem"; echo "Account cannot be deleted.
						<a href='../../views/deleteaccount.php'> Try again..</a>";}

		} else { echo "Email problem"; echo "Account cannot be deleted.
						<a href='../../views/deleteaccount.php'> Try again..</a>";}

	}

?>