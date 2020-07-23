<?php
ob_start();

include("design/bootstrap.html");
include("../codesnippets/ifsessionISNOTset.php");
include("html/deleteaccount.html");

ob_flush();
?>