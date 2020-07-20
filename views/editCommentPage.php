<?php

ob_start();
include("../codesnippets/ifsessionISNOTset.php");

?>

<!-- HTML contains PHP code -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit comment</title>
<div>
	<form action="../controller/cmtApi/updateComment.php?cmt_id=<?php echo $_GET['cmt_id'];?>&post_id=<?php echo $_GET['post_id']?>" method="post">

		<?php
			$old_comment = $_GET['cmt'];
			$cmt_id = $_GET['cmt_id'];
			$post_id = $_GET['post_id'];
		?>

		<!-- edit comment text -->
			Edit comment
			<a href="viewPost.php?post_id=<?php echo $post_id;?>"><b style="font-style: italic;">Cancel</b></a>
		<hr>
		<!-- input box for modified comment -->
		<div>
			<textarea name="comment" rows="5" cols="50" maxlength="10000" required><?php echo $old_comment; ?></textarea>	
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