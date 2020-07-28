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
		//get user id
		$user->id = isset($_SESSION['id']) ? $_SESSION['id'] : die();
		
		//updated details set to the user attributes
		$user->name = $_POST['name'];
		$user->birthday = $_POST['birthday'];
		$user->profession = $_POST['profession'];
		$user->biography = $_POST['bio'];

		if ($user->update_user()){
				
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['profession'] = $_POST['profession'];
			$_SESSION['biography'] = $_POST['bio'];

			header('Location: ../../views/profile.php?user_id='.$_SESSION['id']);

		} else {
			echo "Update failed. <a href='../../profile.php?user_id=<?php echo $user->id?>'> Try again </a>";
		}	
	}	

?>