<?php
session_start();
if (isset($_SESSION['id'])){
	header('Location: views/newsfeed.php');
	exit();
}
include ('views/html/login.html');
?>