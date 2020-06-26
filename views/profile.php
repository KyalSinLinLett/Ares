<!DOCTYPE html>
<html>
<head>
	<title>Your profile</title>
	<link rel="stylesheet" type="text/css" href="profilepage/main.css">
</head>
<body>
		<div>
			<div class="profile-card">
				<?php
					include_once '../controller/api/getUser.php';
				?>

				<img src="https://cdn5.vectorstock.com/i/1000x1000/07/39/man-avatar-profile-view-vector-22890739.jpg">

				<h1><?php echo $name; ?></h1>
				<p class='title'><?php echo $profession; ?></p>
				<div id="information">
					<p># <?php echo $biography; ?></p>
					<p># <?php echo $birthday; ?></p>
					<p># <?php echo $email; ?></p>
				</div>

				<div>
					<button class="btn" type="button">
						<a
							href="editprofile.php?
								name=<?php echo $name;?>
								&birthday=<?php echo $birthday;?>
								&profession=<?php echo $profession;?>
								&biography=<?php echo $biography;?>">
								Edit profile
						</a>
					</button>
					<button class="btn" type="button">
						<a href="../index.php">Go to feed</a>
					</button>
				</div>
			</div>
		</div>
</body>
</html>