<?php

session_start();

//makes sure that the user cannot sign up again or log in once they have already logged in
if (isset($_SESSION['id'])){
	header('Location: newsfeed.php');
	exit();
}

?>

<title>Sign Up</title>
<div>
	<form action="../controller/userApi/createUser.php" method="post">

		<!-- php code for showing error message -->
		<?php
		if (isset($_GET['message'])){
			echo "<small style='color: red; font-style:italic;'>".$_GET['message']."</small>";
		}
		?>

		<!-- Sign up text -->
		<span>Sign Up</span>
		<hr>
		<!-- Name input box -->
			
		<div>
			Name
			<input type="text" name="name" required>
		</div>
		<br>
		<!-- Email input box -->
		<div>
			Email
			<input type="email" name="email" required>
		</div>
		<br>
		<!-- Password input box -->

		<div>
			Password
			<input type="password" name="password" required>
		</div>
		<br>

		<!-- Confirm password input box -->
			
		<div>
			Confirm password
			<input class="input100" type="password" name="cpassword" required>
		</div>
		<br>

		<!-- birthday input box -->
			
		<div>
			Birthday
			<input class="input100" type="date" name="birthday" required>
		</div>
		<br>

		<!-- profession input box -->
		<div>
			Profession
			<input type="text" name="profession" placeholder="i.e. Student" required>
		</div>
		<br>
		<!-- Bio input box -->
		<div>
			<p>Add Bio</p>
			<textarea name="bio" rows="20" cols="50"></textarea>
		</div>
		<hr>
		<!-- signup button -->
		<div>
			<input type="submit" name="submit" value="Sign Up">
		</div>
	</form>
	<!-- Asking if user already has an account -->
	<div>
		<p style="font-style: italic;">Already a member of Ares?<a href="../index.php" class="txt3">
			<b>Log in</b>
		</a></p>
	</div>
</div>
