<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<?php

		session_start();
		if (isset($_SESSION['id'])){
			header('Location: feed.php');
			exit();
		}

	?>
	<form action="../controller/login_validation.php" method="post">
		<div>
			<input type="text" name="email" placeholder="Email" required>
		</div>
		<div>
			<input type="password" name="password" placeholder="Password" required>
		</div>
		<input type="submit" name="submit" value="Login">
		<div>
			<a href="#"><small>Forgot password?</small></a>
		</div>
	</form>

	<p>New to ares?</p><a href="signup.php"> Sign up </a><p>right now!</p>
</body>
</html>