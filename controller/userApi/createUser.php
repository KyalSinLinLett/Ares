<?php  
	session_start();

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	//Instantiate db
	$database = new Database();
	$db = $database->connect();

	//Instantiate user object
	$user = new User($db);

	//when submit button is clicked
	if (isset($_POST['submit'])){

		//gets the password from pwd and confirm pwd input boxes
		$pwd_f1 = $_POST['password'];
		$pwd_f2 = $_POST['cpassword'];

		//checks if the two is identical
		if (strcmp($pwd_f1, $pwd_f2) == 0){
			//sets the unhashed password
			$unhashed_password = $_POST['password'];
			//hashed the password
			$hashed_password = password_hash($unhashed_password, PASSWORD_DEFAULT);

			$raw_data = array(
				'name' => $_POST['name'],
				'password' => $hashed_password,
				'email' => $_POST['email'],
				'birthday' => $_POST['birthday'],
				'profession' => $_POST['profession'],
				'biography' => $_POST['bio']
			);

			$data = json_encode($raw_data);
			$data = json_decode($data);

			//bind data into the user object
			$user->name = $data->name;
			$user->password = $data->password;
			$user->email = $data->email;
			$user->birthday = $data->birthday;
			$user->profession = $data->profession;
			$user->biography = $data->biography;

			if ($user->create_user()){
				echo "User Created";
				header("location: ../../index.php");
			} else {
				$message = "Failed to create user. Email in use.";
				header("Location: ../../views/signup.php?message=$message");
			}
		} else {
			$message = "Passwords do not match!";
			header("Location: ../../views/signup.php?message=$message");
		}
		
	}
?>