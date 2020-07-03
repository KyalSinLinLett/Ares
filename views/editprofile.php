<?php

include("../codesnippets/ifsessionISNOTset.php");
include("UIUX/snippets/toplinks.html");

?>
<title>Edit profile</title>
<div class="limiter">
	<div class="container-login100">
		<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);   border-radius: 3rem;"class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<form action="../controller/userApi/updateUser.php" method="post" class="login100-form validate-form flex-sb flex-w">

				<?php

					// GET - catch data using GET
					// REQUEST - catch data using POST and GET
					$name = $_GET['name'];
					$birthday = $_GET['birthday'];
					$profession = $_GET['profession'];
					$biography = $_GET['biography'];
				?>

				<!-- edit profile text -->
				<span class="login100-form-title p-b-32">
					Edit profile &nbsp&nbsp&nbsp&nbsp
					<a href="../index.php"><b style="font-style: italic;">Cancel</b></a>
				</span>

				<!-- name text and input box -->
				<span class="txt1 p-b-11">
					Name
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Name is required">
					<input class="input100" type="text" name="name" value="

					<?php echo $name; ?>">
					
					<span class="focus-input100"></span>
				</div>

				<!-- Birthday text and date input box -->
				<span class="txt1 p-b-11">
					Birthday
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Birthday is required">
					<input class="input100" type="date" name="birthday" value="

					<?php echo $birthday; ?>">
					
					<span class="focus-input100"></span>
				</div>

				<!-- profession text and input box -->
				<span class="txt1 p-b-11">
					Profession
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Profession is required">
					<input class="input100" type="text" name="profession" value="

					<?php echo $profession;?>"

					placeholder="i.e. Student">
					<span class="focus-input100"></span>
				</div>

				<!-- Add bio text and input box -->
				<span class="txt1 p-b-11">
					Add bio
				</span>
				<div class="wrap-input100 validate-input m-b-23" data-validate = "Bio is required">
					<input class="input100" type="text" name="bio" value="

					<?php echo $biography;?>" 

					placeholder="A sentence describing yourself.">
					<span class="focus-input100"></span>
				</div>

				<!-- update button -->
				<div class="container-login100-form-btn">
					<button class="login100-form-btn" name="submit">
						Update
					</button>
				</div>
			</form>

			<br>

			<!-- more functions -->
			<div class="flex-sb-m w-full p-b-48">
				<div>
					<a href="changepasswordpage.php"><b style="font-style: italic;">Change password?</b></a>
					<a href="deleteaccount.php"><b style="font-style: italic;">Delete account?</b></a>
				</div>
				<div>
					
				</div>
			</div>

		</div>
	</div>
</div>

<?php 
include('UIUX/snippets/btmlinks.html');
?>