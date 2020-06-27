<!DOCTYPE html>
<html>
<head>
	<title>Ares feed</title>
	<link rel="stylesheet" type="text/css" href="views/profilepage/main.css">
</head>
<body>
	
	<?php  

		session_start();

		if (!isset($_SESSION['id'])){

		?>

		<button class="btn" type="button">
			<a href='views/login.php'>Login here</a><br>
		</button>

		<button class="btn" type="button">
			<a href='views/signup.php'>Sign Up</a>
		</button>	

			<div class="welcome-card">
				<div>
					<p class="welcome">Welcome to ARES.</p>
				</div>

				<p class="site-information">Ares is a social network.</p>
			</div>

		<?php
		} else {

		?>
			<button class="btn" type="button">
				<a href='views/profile.php'>View your profile</a>
			</button>

			<button class="btn" type="button">
				<a href='controller/logout.php'>Log out</a>		
			</button>				

			<div class="welcome-card">
				<div>
					<p class="welcome">Welcome to your feed, <?php
						echo $_SESSION['name']; ?></p>
				</div>
				<div>
					<p class="site-information">Wow, such empty.</p>
				</div>
			</div>

		<?php

		}

	

	?>




</body>
</html>