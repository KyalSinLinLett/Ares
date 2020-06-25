<?php  

	header('Access-Control-Allow-Origin: *');
	//header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once "../../dbconnector/Database.php";
	include_once "../../models/User.php";

	//Instantiate db
	$database = new Database();
	$db = $database->connect();

	//Instantiate user object
	$user = new User($db);

	if (isset($_POST['submit'])){

		$unhashed_password = $_POST['password'];
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
			header("location: ../../views/profile.php");
		} else {
			echo "Failed to create user";
			echo "<a href='../../views/signup.php'>Try again</a>";
		}
	}
?>