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
			<div class="welcome-card">
				<div>
					<p class="welcome">Welcome to ARES.</p>
				</div>

				<p class="site-information">Ares is a social network.</p>
			</div>

			<div class="info-card">
					<button class="btn" type="button">
						<a href='views/login.php'>Login here</a><br>
					</button>

					<button class="btn" type="button">
						<a href='views/signup.php'>Sign Up</a>
					</button>			
			</div>

		<?php
		} else {

		?>

			<div>
				<button class="btn" type="button">
					<a href='views/profile.php'>View your profile</a>
				</button>

				<button class="btn" type="button">
					<a href='controller/logout.php'>Log out</a>		
				</button>				
			</div>

			<div class="welcome-card">
				<div>
					<p class="welcome">Welcome to your feed, <?php
						echo $_GET['name']; ?></p>
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