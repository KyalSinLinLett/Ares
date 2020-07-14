<?php 

	// header("Access-Control-Allow-Origzin: *");
	// header("Access-Control-Allow-Methods: GET");
	// //header("Content-Type: application/json");
	// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../dbconnector/Database.php";
	include_once "../models/Search.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$search = new Search($db);

	if (isset($_POST['search'])){

		$user_id = $_POST['user_id'];

		$search->s_query = $_POST['s_query'];
			
		if (strcmp($_POST['search_by'], "User")==0){
			$result = $search->search_user();
		} else if (strcmp($_POST['search_by'], "Post")==0){
			$result = $search->search_post();
		}

	}

	


?>