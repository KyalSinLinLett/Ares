<?php 

	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Allow-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Authorization, X-Requested-With");

	include_once "../../dbconnector/Database.php";
	include_once "../../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	if (isset($_POST['submit'])){

		if (is_uploaded_file($_FILES['postpics']['tmp_name'])){

			$img = $_FILES['postpics']['name'];
			$tmp = $_FILES['postpics']['tmp_name'];

			$code = bin2hex(random_bytes(15));
			$newimgname = $code . $img;

			$post->user_id = $_SESSION['id'];
			$post->title = $_POST['title'];
			$post->content = $_POST['content'];
			$post->postpics = $newimgname;

			if ($newimgname){
			    move_uploaded_file($tmp, "../../images/postpics/" . $newimgname);
			}

			//create post
			if ($post->create_post()){
				header('location: ../../views/profile.php?user_id='.$post->user_id);
			} else {
				echo "post not created";
			}
			
		} else {
			$post->user_id = $_SESSION['id'];
			$post->title = $_POST['title'];
			$post->content = $_POST['content'];
			$post->postpics = null;

			//create post
			if ($post->create_post()){
				header('location: ../../views/profile.php?user_id='.$post->user_id);
			} else {
				echo "post not created";
			}
		}

	}

?>