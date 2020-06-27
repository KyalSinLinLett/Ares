<?php

session_start();
if (isset($_SESSION['id'])){
	header('Location: ../index.php');
	exit();
}

include("UIUX/snippets/toplinks.html");

?>

<title>Sign Up</title>
<div class="limiter">
	<div class="container-login100">
		<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);   border-radius: 3rem;"class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<form action="../controller/api/createUser.php" method="post" class="login100-form validate-form flex-sb flex-w">
				<?php
				if (isset($_GET['message'])){
					echo "<small style='color: red; font-style:italic;'>".$_GET['message']."</small>";
				}
				?>
				<span class="login100-form-title p-b-32">
					Sign Up
				</span>

				<span class="txt1 p-b-11">
					Name
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Name is required">
					<input class="input100" type="text" name="name" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					email
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Email is required">
					<input class="input100" type="email" name="email" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Password
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
					<input class="input100" type="password" name="password" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Confirm password
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
					<input class="input100" type="password" name="cpassword" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Birthday
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Birthday is required">
					<input class="input100" type="date" name="birthday" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Profession
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Profession is required">
					<input class="input100" type="text" name="profession" placeholder="i.e. Student">
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Add bio
				</span>
				<div class="wrap-input100 validate-input m-b-23" data-validate = "Bio is required">
					<input class="input100" type="text" name="bio" placeholder="A sentence describing yourself.">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" name="submit">
						Sign Up
					</button>
				</div>
			</form>

			<br>
			<div class="flex-sb-m w-full p-b-48">
				<div>
					<p style="font-style: italic;">Already a member of Ares?<a href="login.php" class="txt3">
						<b>Log in</b>
					</a></p>
				</div>
			</div>


		</div>
	</div>
</div>

<?php 
include('UIUX/snippets/btmlinks.html');
?>