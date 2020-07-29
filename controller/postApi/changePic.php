<?php 

session_start();

header("Allow-Access-Control-Origin: *");
header("Allow-Access-Control-Methods: post");
header("Allow-Access-Control-Headers: Allow-Access-Control-Headers, Allow-Access-Control-Methods, Authorization, X-Requested-With");

include_once "../../dbconnector/Database.php";
include_once "../../models/Post.php";

//instantiate database
$database = new Database();
$db = $database->connect();

//instantiate post obj
$post = new Post($db);

if (isset($_POST['submit'])){
	
	$img = $_FILES['postpics']['name'];
	$tmp = $_FILES['postpics']['tmp_name'];

	$code = bin2hex(random_bytes(15));
	$newimgname = $code . $img;

	$user->id = $_SESSION['id'];
	$user->profilepic = $newimgname;

	if ($newimgname){
	    move_uploaded_file($tmp, "../../images/postpics/" . $newimgname);
	}

	$post->post_id = $_GET['post_id'];
	$post->postpics = $newimgname;

	//execute query - edit
	if ($post->change_pic()){
		header("location: ../../views/editPostPage.php?title=".$_GET['title']."&post_id=".$post->post_id);
	} else {
		echo "pic not changed";
	}
}

 

?>