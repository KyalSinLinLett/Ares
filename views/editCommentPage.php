<?php

ob_start();
include("../codesnippets/ifsessionISNOTset.php");

?>

<!-- HTML contains PHP code -->
<title>Edit comment</title>
<div>
	<form action="../controller/cmtApi/updateComment.php?user_id=<?php echo $_GET['user_id']?>&cmt_id=<?php echo $_GET['cmt_id'];?>&post_id=<?php echo $_GET['post_id']?>" method="post">

		<?php
			// $user_id = $_GET['user_id'];
			$old_comment = $_GET['cmt'];
			// $cmt_id = $_GET['cmt_id'];
			// $post_id = $_GET['post_id'];
		?>

		<!-- edit comment text -->
			Edit comment
			<a href="viewPost.php?user_id=<?php echo $user_id; ?>&post_id=<?php echo $post_id;?>"><b style="font-style: italic;">Cancel</b></a>
		<hr>
		<!-- input box for modified comment -->
		<div>
			<textarea name="comment" rows="5" cols="50" required><?php echo $old_comment; ?></textarea>	
		</div>
		<hr>
		<!-- edit button -->
		<div>
			<input type="submit" name="submit" value="Edit">
		</div>
	</form>
</div>

<?php 
ob_flush();
?>