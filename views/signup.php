<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>

	<?php

		session_start();
		if (isset($_SESSION['id'])){
			header('Location: feed.php');
			exit();
		}

	?>

	<form action="../controller/api/createUser.php" method="post">
		<div>
			<input type="text" name="name" placeholder="Name" required>
		</div>
		<div>
			<input type="email" name="email" placeholder="Email Address" required>
		</div>
		<div>
			<input type="password" name="password" placeholder="Password" required>
		</div>
		<div>
			<input type="date" name="birthday" placeholder="YYYY-MM-DD" required>
		<div>
			<input type="text" name="profession" placeholder="Profession." required>
		</div>
		<div>
			<input type="text" name="bio" placeholder="Tell us a little about yourself." required>
		</div>
		<div>
			<input type="submit" name="submit" value="Register">
		</div>
	</form>

	<p>Already a member of Ares?</p><a href="login.php"> Log In </a><p>right now!</p>

</body>
</html>