<?php
ob_start();

include("../codesnippets/ifsessionISNOTset.php");

?>
<title>Edit profile</title>
<div>
			<form action="../controller/userApi/updateUser.php" method="post">

				<?php

					// GET - catch data using GET
					// REQUEST - catch data using POST and GET

					$user_id = $_GET['user_id'];
					$name = $_GET['name'];
					$birthday = $_GET['birthday'];
					$profession = $_GET['profession'];
					$biography = $_GET['biography'];
				?>

				<!-- edit profile text -->
				Edit profile
				<a href="newsfeed.php?user_id=<?php echo $user_id?>"><b style="font-style: italic;">Cancel</b></a>
				<hr>
				<!-- name text and input box -->
				<div>
					Id
					<input type="text" name="user_id" value="<?php echo $user_id; ?>" readonly>
				</div>
				<br>
				<div>
					Name
					<input type="text" name="name" value="<?php echo $name; ?>">
				</div>
				<br>
				<!-- Birthday text and date input box -->
				<div>
					Birthday
					<input type="date" name="birthday" value="<?php echo $birthday; ?>">
				</div>
				<br>
				<!-- profession text and input box -->
				<div>
					Profession
					<input type="text" name="profession" value="<?php echo $profession;?>" placeholder="i.e. Student">
				</div>
				<br>
				<!-- Add bio text and input box -->
				<div>
					<p>Add bio</p>
					<textarea name="bio" rows="10" cols="50" placeholder="A sentence describing yourself."><?php echo $biography;?></textarea>
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
				<a href="changepasswordpage.php?user_id=<?php echo $user_id?>"><b style="font-style: italic;">Change password?</b></a>
				<a href="deleteaccount.php?user_id=<?php echo $user_id;?>"><b style="font-style: italic;">Delete account?</b></a>
			</div>
</div>

<?php 
ob_flush();
?>