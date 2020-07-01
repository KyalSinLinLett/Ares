<!DOCTYPE html>
<html>
<head>
	<title>Edit post</title>
</head>
<body>

	<?php 

		session_start();
		
		if (!isset($_SESSION['id'])){
			exit();
		}
		
		$title = isset($_GET['title']) ? $_GET['title'] : die();
		$content = isset($_GET['content']) ? $_GET['content'] : die();
		$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die(); 
	?>

	<div>
		<form action="../controller/postApi/editPost.php?post_id=<?php echo $post_id;?>" method="post">
			<input type="text" name="title" placeholder="Title" value="<?php echo $title;?>">
			<input type="textarea" name="content" placeholder="Content" value="<?php echo $content;?>">
			<input type="submit" name="submit" value="Edit">
		</form>
	</div>


</body>
</html>