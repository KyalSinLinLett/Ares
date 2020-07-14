<?php
ob_start();

$user_id = $_GET['user_id'];
include("../codesnippets/ifsessionISNOTset.php");
include("html/changepasswordpage.html");

ob_flush();
?>