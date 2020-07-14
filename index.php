<?php

session_start();
if (isset($_SESSION['id'])){
	header('Location: views/newsfeed.php?user_id='.$_SESSION['id']);
	exit();
}
include ('views/html/login.html');
?>