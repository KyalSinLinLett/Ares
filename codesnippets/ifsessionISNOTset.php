<?php
session_start();
if (!isset($_SESSION['id'])){
    header('Location: ../index.php');
	exit();
}
?>

<!-- include("../codesnippets/ifsessionISNOTset.php"); -->
