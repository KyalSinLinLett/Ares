<!DOCTYPE html>
<html>
<head>
	<title>Ares feed</title>
</head>
<body>
	
	<p>This is the home page of Ares.</p>

	<?php  

		session_start();

		if (!isset($_SESSION['id'])){
			echo "<a href='views/login.php'>Login here</a>"."<br>";
			echo "<a href='views/signup.php'>Sign Up here</a>";
		} else {
			echo "<a href='views/profile.php'>View your profile</a>";		
			echo "<a href='controller/logout.php'>Log out</a>";
		}

	?>


</body>
</html>