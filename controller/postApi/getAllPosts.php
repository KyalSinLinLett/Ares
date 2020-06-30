<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: GET");
	//header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../dbconnector/Database.php";
	include_once "../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	//set the user id
	$post->user_id = isset($_SESSION['id']) ? $_SESSION['id'] : die();

	//set the result to $rs
	$result = $post->get_all_posts();

	return $result;


	//get row count
	// $num_row = $result->rowCount();

	// if ($num_row > 0){

	// 	//post array
	// 	$post_array = array();
	// 	$post_array['data'] = array();

	// 	while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
	// 		extract($rs);

	// 		$post_data = array(
				

	// 		);

	// 		array_push($post_array['data'], $post_data);
	// 	}

	// 	echo json_encode($post_array);	

	// } else {
	// 	print_r(json_encode(array("message"=> "user or post doesn't exist")));
	// }
		

		





?>