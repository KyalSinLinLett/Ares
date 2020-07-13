<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
</head>
<body>
	<?php
	ob_start();

	include("../codesnippets/ifsessionISNOTset.php");
	include("../controller/postApi/getPostContent.php");

	$title = isset($_GET['title']) ? $_GET['title'] : die();
	$content = $cont['content'];
	$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die(); 

	?>

	<div>
		<form action="../controller/postApi/editPost.php?post_id=<?php echo $post_id;?>" method="post">

			<b>Edit post</b>
			<a href="profile.php?user_id=<?php echo $_SESSION['id']?>"><b style="font-style: italic;">Cancel</b></a>
			<hr>
			<!-- Title -->
			<div>
				<b>Title</b>
				<input type="text" name="title" value="<?php echo $title; ?>">
			</div>
			<br>
			<!-- Content -->
			<div>
				<b>Content</b>
				<textarea name="content" rows="15" cols="50"><?php echo $content;?></textarea>
			</div>
			<hr>
			<!-- Edit button -->
			<div>
				<input type="submit" name="submit" value="Edit">
			</div>
		</form>
	</div>

	<?php
		ob_flush();
	?>

</body>
</html>