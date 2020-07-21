<?php

session_start();

//makes sure that the user cannot sign up again or log in once they have already logged in
if (isset($_SESSION['id'])){
	header('Location: newsfeed.php?name='.$_SESSION['name']);
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="loginform/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginform/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="loginform/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="loginform/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginform/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form action="../controller/userApi/createUser.php" method="post" class="login100-form validate-form flex-sb flex-w">
					<!-- php code for showing error message -->
					<?php
					if (isset($_GET['message'])){
						echo "<small style='color: red; font-style:italic;'>".$_GET['message']."</small>";
					}
					?>

					<h4>Join d3v-overfl0w<img height="75%" width="20%" src="img/dinosaur.gif"></h4>

					<span class="login100-form-title p-b-51 p-t-25">
						Sign Up
					</span>

					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Email is required">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="cpassword" placeholder="Confirm password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Birthday is required">
						<input class="input100" type="date" name="birthday" placeholder="Birthday">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Profession is required">
						<input class="input100" type="text" name="profession" placeholder="Profession">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Biography is required">
						<input class="input100" type="text" name="biography" placeholder="Biography">
						<span class="focus-input100"></span>
					</div>
					

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="submit">
							Sign Up
						</button>
					</div>
				</form>

				<div class="flex-sb-m w-full p-b-48 p-t-10">
					<div>
						<p style="font-style: italic;">Already a member?<a href="../index.php" class="txt3">
							<b>Log in</b>
						</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="loginform/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="loginform/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="loginform/vendor/bootstrap/js/popper.js"></script>
	<script src="loginform/vendor/bootstrap/js/bootstrap.min.js"></script>S
<!--===============================================================================================-->
	<script src="loginform/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="loginform/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginform/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="loginform/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="loginform/js/main.js"></script>

</body>
</html>