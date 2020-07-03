<?php

include("../codesnippets/ifsessionISNOTset.php");

$title = isset($_GET['title']) ? $_GET['title'] : die();
$content = isset($_GET['content']) ? $_GET['content'] : die();
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die(); 

include("UIUX/snippets/toplinks.html");

?>
<title>Edit profile</title>
<div class="limiter">
	<div class="container-login100">
		<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);   border-radius: 3rem;"class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<form action="../controller/postApi/editPost.php?post_id=

			<?php echo $post_id;?>" 

			method="post" class="login100-form validate-form flex-sb flex-w">

				<!-- Edit post text -->
				<span class="login100-form-title p-b-32">
					Edit post &nbsp&nbsp&nbsp&nbsp
					<a href="profile.php"><b style="font-style: italic;">Cancel</b></a>
				</span>

				<!-- Title text with input box for edited title -->
				<span class="txt1 p-b-11">
					Title
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Title is required">
					<input class="input100" type="text" name="title" value="

					<?php echo $title; ?>">

					<span class="focus-input100"></span>
				</div>

				<!-- Content text with input box for edited content -->
				<span class="txt1 p-b-11">
					Content
				</span>
				<div class="wrap-input100 validate-input m-b-23" data-validate = "Content cannot be empty">
					<input class="input100" type="text" name="content" value="

					<?php echo $content;?>" 

					placeholder="Anything you would like to share.">
					<span class="focus-input100"></span>
				</div>

				<!-- Edit button -->
				<div class="container-login100-form-btn">
					<button class="login100-form-btn" name="submit">
						Edit
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
include('UIUX/snippets/btmlinks.html');
?>