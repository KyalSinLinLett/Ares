<?php
ob_start();

include("design/bootstrap.html");
include("../codesnippets/ifsessionISNOTset.php");
include("html/changepasswordpage.html");

ob_flush();
?>