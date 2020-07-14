<!DOCTYPE html>
<html>
<head>
<title>View Post</title>
<!-- <link rel="stylesheet" type="text/css" href="profilepage/main.css">
 --></head>
<body>

<?php

	// ob_start();
		session_start();

?>

<?php

include_once "../controller/postApi/getPost.php";
include_once "../controller/likeApi/getLikes.php";

?>

<button class="homebtn" type="button">
<a href="newsfeed.php?user_id=<?php echo $_GET['user_id'];?>">Go to feed</a>
</button>

<br>
<hr>
<!-- show post content -->
<div class="card">
<p><b><?php print_r($post_data['title']);?></b></p>
<p><?php print_r($post_data['content']);?></p>
<p><?php print_r($post_data['posted_at']);?></p>
<p>Likes: <?php echo $likecount; ?></p>


<!-- Profile links based on logged in user -->
<?php
	//if the post author is the logged in user 
	if (strcmp($_GET['user_id'], $post_data['posted_by']) == 0){

?>

	<p>Author: <a class="profilelinks" href="profile.php?user_id=<?php echo $_GET['user_id']?>"><?php print_r($post_data['author']);?></a></p>

<?php
		
	} else {
?>

	<p>Author: <a class="profilelinks" href="viewProfilePage.php?user_id=<?php echo $_GET['user_id']?>&posted_by=<?php print_r($post_data['posted_by'])?>"><?php print_r($post_data['author']);?></a></p>

<?php
		}
?>
<hr>
<!-- likes -->
<?php 
	
		$user_id = $_GET['user_id'];

		// is this post already been liked by user?
		include_once "../controller/check_liked.php";
		if ($condition > 0){ //means already liked

		?>
			<!-- Show unlike button -->
			<button class="btn" type="button">
				<a href="../controller/likeApi/unlike.php?user_id=<?php echo $user_id;?>&posted_by=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>">Unlike</a>
			</button>
			
		<?php
		} else {
		?>	
			<!-- show like button -->
			<button class="btn" type="button">
				<a href="../controller/likeApi/addLike.php?user_id=<?php echo $user_id;?>&posted_by=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>">Like</a>
			</button>
			
		<?php
		}	
		

?>

<!-- show edit, delete buttons if user is logged in -->
<?php 
	if ($post_data['posted_by'] == $_GET['user_id']){
?>
	<hr>
	<button class="btn" type="button">
		<a href="editPostPage.php?user_id=<?php echo $_GET['user_id'];?>&title=<?php print_r($post_data['title']);?>&post_id=<?php print_r($post_data['post_id']);?>">Edit</a>
	</button>
	<button class="btn" type="button">
		<a onClick="javascript: return confirm('Please comfirm deletion');" href="../controller/postApi/deletePost.php?user_id=<?php echo $_GET['user_id']?>&post_id=<?php print_r($post_data['post_id']); ?>">Delete</a>
	</button>

<?php
	}
?>
	
</div>
<hr>

<!-- Adding comments -->

<?php

if (isset($_SESSION['id'])){

?>
	<hr>
	<div class="card">
		<form action="../controller/cmtApi/addComment.php?user_id=<?php echo $_SESSION['id']; ?>&post_id=<?php print_r($post_data['post_id']);?>" method="POST">
			<input type="text" name="cmt" placeholder="Add a comment" required>
			<input type="submit" name="submit" value="Add" required>
		</form>
	</div>

<?php

}

?>

<!-- Getting comments -->

<?php

include_once "../controller/cmtApi/getComments.php";

$num_rows = $result->rowCount();

if ($num_rows > 0){

	while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
		extract($rs);

		$cmt_data = array(
			"cmt_id" => $rs['cmt_id'],
			"comment" => $rs['comment'],
			"posted_at" => $rs['posted_at'],
			"posted_by" => $rs['posted_by'],
			"author" => $rs['name']
		);

?>
	<hr>
	<div class="comment-card">
		<p>> <?php print_r($cmt_data['comment']);?></p>
		<p><?php print_r($cmt_data['posted_at']);?></p>
		
		
				
		<?php
			if (strcmp($_GET['user_id'], $cmt_data['posted_by']) == 0){
		?>

				<a class="profilelinks" href="profile.php?user_id=<?php echo $cmt_data['posted_by']?>"><p><?php print_r($cmt_data['author'])?></p></a>
				<button class="btn" type="button">
				<a onClick="javascript: return confirm('Please comfirm deletion');" href="../controller/cmtApi/deleteComment.php?post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id'])?>&user_id=<?php print_r($_GET['user_id']); ?>">Delete</a>
				</button>

				<button class="btn" type="button">
				<a href="editCommentPage.php?user_id=<?php echo $_GET['user_id']?>&post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id']);?>&cmt=<?php print_r($cmt_data['comment']);?>">Edit</a>
				</button>

		<?php

			} else {

		?>
			<a class="profilelinks" href="viewProfilePage.php?user_id=<?php echo $_GET['user_id']?>&posted_by=<?php print_r($cmt_data['posted_by'])?>"><p><?php print_r($cmt_data['author']);?></p></a>
		<?php
			}
		?>

			
	</div>

<?php

	}

} 

?>

<?php 
ob_flush();
?>


</body>
</html>