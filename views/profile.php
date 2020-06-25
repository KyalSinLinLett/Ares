<!DOCTYPE html>
<html>
<head>
	<title>Your profile</title>
</head>
<body>
	<div class="row">
		<div class="col-5">
			<div>
				<?php
					include_once '../controller/api/getUser.php';
				?>
				<table>
					<tr>
						<td>
						Name: <br>
						<?php echo $name; ?>	
						</td>
					</tr>
					<tr>
						<td>
						Birthday: <br>
						<?php echo $birthday; ?>
						</td>
					</tr>
					<tr>
						<td>
						Profession: <br>
						 <?php echo $profession; ?>
						</td>
					</tr>
					<tr>
						<td>
						Biography: <br>
						<?php echo $biography; ?>
						</td>
					</tr>
					<tr>
						<td>
						Email: <br>
						<?php echo $email; ?>
						</td>
					</tr>
				</table>
			</div>

			<a 
				href="editprofile.php?
					name=<?php echo $name;?>
					&birthday=<?php echo $birthday;?>
					&profession=<?php echo $profession;?>
					&biography=<?php echo $biography;?>">
				Edit profile
			</a>
			<a href="feed.php">Go to feed</a>
		</div>
	</div>
</body>
</html>