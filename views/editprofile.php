<?php
ob_start();

include("../codesnippets/ifsessionISNOTset.php");

?>
<title>Edit profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div>
			<form action="../controller/userApi/updateUser.php" method="post">

				<?php

					// GET - catch data using GET
					// REQUEST - catch data using POST and GET
					$name = $_GET['name'];
					$birthday = $_GET['birthday'];
					$profession = $_GET['profession'];
					$biography = $_GET['biography'];
				?>

				<!-- edit profile text -->
				Edit profile
				<a href="newsfeed.php"><b style="font-style: italic;">Cancel</b></a>
				<hr>
				<!-- name text and input box -->
				<div>
					Name
					<input type="text" name="name" value="<?php echo $name; ?>" required>
				</div>
				<br>
				<!-- Birthday text and date input box -->
				<div>
					Birthday
					<input type="date" name="birthday" value="<?php echo $birthday; ?>" required>
				</div>
				<br>
				<!-- profession text and input box -->
				<div>
					Profession
					<input type="text" name="profession" value="<?php echo $profession;?>" placeholder="i.e. Student" required>
				</div>
				<br>
				<!-- Add bio text and input box -->
				<div>
					<p>Add bio</p>
					<textarea name="bio" rows="10" cols="50" placeholder="A sentence describing yourself." required><?php echo $biography;?></textarea>
				</div>
				<hr>
				<!-- update button -->
				<div>
					<input type="submit" name="submit" value="Update profile">
				</div>
			</form>

			<br>

			<!-- more functions -->
			<div>
				<a href="changepasswordpage.php"><b style="font-style: italic;">Change password?</b></a>
				<a href="deleteaccount.php"><b style="font-style: italic;">Delete account?</b></a>
			</div>
</div>

<?php 
ob_flush();
?>