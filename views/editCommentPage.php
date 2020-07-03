<?php

include("../codesnippets/ifsessionISNOTset.php");

include("UIUX/snippets/toplinks.html");

?>

<!-- HTML contains PHP code -->
<title>Edit comment</title>
<div class="limiter">
	<div class="container-login100">
		<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);   border-radius: 3rem;"class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<form action="../controller/cmtApi/updateComment.php?cmt_id=
								<?php echo $_GET['cmt_id'];?>
							 &post_id=
							 	<?php echo $_GET['post_id']?>"
			method="post" class="login100-form validate-form flex-sb flex-w">


				<?php
					$old_comment = $_GET['cmt'];
					$cmt_id = $_GET['cmt_id'];
					$post_id = $_GET['post_id'];
				?>

				<!-- edit comment text -->
				<span class="login100-form-title p-b-32">
					Edit comment &nbsp&nbsp&nbsp&nbsp
					<a href="viewPost.php?post_id=
												<?php echo $post_id;?>
					"><b style="font-style: italic;">Cancel</b></a>
				</span>

				<!-- input box for modified comment -->
				<div class="wrap-input100 validate-input m-b-12" data-validate = "Cannot be empty">
					<input class="input100" type="text" name="comment" value="
					<?php echo $old_comment; ?>">
					
					<span class="focus-input100"></span>
				</div>

				<!-- edit button -->
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