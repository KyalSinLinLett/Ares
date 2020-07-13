<?php

	include_once "../dbconnector/Database.php";
	include_once "../models/Post.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$post = new Post($db);

	$post->post_id = $_GET['post_id'];

	$result = $post->get_content();

	$cont = $result->fetch(PDO::FETCH_ASSOC);

?>