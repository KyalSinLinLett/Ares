<?php
	session_start();
	if (isset($_SESSION['id'])){
		header('Location: ../index.php');
		exit();
	}
	include('UIUX/snippets/toplinks.html');

?>	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form action="../controller/login_validation.php" method="post" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Login
					</span>

					<span class="txt1 p-b-11">
						Email
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Email is required">
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
					
					<div class="flex-sb-m w-full p-b-30">
						<div>
							<a href="forgetpasswordform.php" class="txt3">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit">
							Login
						</button>
					</div>
				</form>
				<br>
				<div class="flex-sb-m w-full p-b-48">
					<div>
						<p style="font-style: italic;">New to Ares?<a href="signup.php" class="txt3">
							<b>Sign Up</b>
						</a></p>
					</div>
				</div>

			</div>
		</div>
	</div>

<?php 
	include('UIUX/snippets/btmlinks.html');
?>