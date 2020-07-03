<?php
session_start();
if (isset($_SESSION['id'])){
	header('Location: ../index.php');
	exit();
}
include('UIUX/snippets/toplinks.html');	
include ('html/login.html');
include('UIUX/snippets/btmlinks.html');
?>