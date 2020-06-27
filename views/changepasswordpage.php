	<?php
	
	session_start();
	if (!isset($_SESSION['id'])){
		exit();
	}

	include("UIUX/snippets/toplinks.html");

	?>
	<title>Change password</title>
	<div class="limiter">
		<div class="container-login100">
			<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);   border-radius: 3rem;"class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form action="../controller/change_password.php" method="post" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Change password &nbsp
						<a href="../index.php"><b style="font-style: italic;">Cancel</b></a>
					</span>

					<span class="txt1 p-b-11">
						Current password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "This field is required">
						<input class="input100" type="password" name="oldpwd">
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						New password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "This field is required">
						<input class="input100" type="password" name="newpwd">
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Confirm new password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "This field is required">
						<input class="input100" type="password" name="cnewpwd">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							Change
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php 
	include('UIUX/snippets/btmlinks.html');
	?>