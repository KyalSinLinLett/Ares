<?php

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	//Instantiate database
	$database = new Database;
	$db = $database->connect();

	//Instantiate object
	$user = new User($db);

	if (isset($_POST['submit'])){

		//set user id
		$user->id = isset($_POST['user_id']) ? $_POST['user_id'] : die();

		//getting the current user password for validation
		$pwd_res = $user->get_hashed_password();

		//setting the hashed pwd variable
		$hashed_pwd = $pwd_res['password'];

		//details form the validation form
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		$cpwd = $_POST['cpassword'];

		// now we check if the pwd submitted is the same as the confirmed one 
		if (strcmp($pwd, $cpwd) == 0){
			//now we make sure the password submitted is the same as the hashed we retrieved with the get_hashed_password()
			if (password_verify($pwd, $hashed_pwd)){
				//sets the final param for the delete query
				$user->password = $hashed_pwd;

				if ($user->delete_account()){
					echo "Account is deleted!";
					echo "<a href='../logout.php'>Log In</a>";
				} else {
					echo "Account cannot be deleted.
					<a href='../../views/deleteaccount.php?user_id='".$user_id."'> Try again..</a>";
				}

			} else { echo "pass verify problem"; echo "Account cannot be deleted.
					<a href='../../views/deleteaccount.php?user_id='".$user_id."'> Try again..</a>";}

		} else {echo "password problem"; echo "Account cannot be deleted.
					<a href='../../views/deleteaccount.php?user_id='".$user_id."'> Try again..</a>";}

	}

?>