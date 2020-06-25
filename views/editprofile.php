<!DOCTYPE html>
<html>
<head>
	<title>Edit profile</title>
</head>
<body>

	<form action="../controller/api/updateUser.php" method="post">

		<?php
			$name = $_REQUEST['name'];
			$birthday = $_REQUEST['birthday'];
			$profession = $_REQUEST['profession'];
			$biography = $_REQUEST['biography'];
		?>

		<div>
			<input type="text" name="name" value="<?php echo $name; ?>" 
			placeholder="Name" required>
		</div>
		<div>
			<input type="date" name="birthday" placeholder="YYYY-MM-DD" value="<?php echo $birthday; ?>"required>
		<div>
			<input type="text" name="profession" placeholder="Profession" value="<?php echo $profession; ?>" required>
		</div>
		<div>
			<input type="text" name="bio" placeholder="Tell us a little about yourself." value="<?php echo $biography; ?>" required>
		</div>
		<div>
			<input type="submit" name="submit" value="Update">
		</div>
	</form>

	<a href="changepasswordpage.html"> Change password </a>
	<a href="deleteaccount.html"> Delete account? </a>

</body>
</html>