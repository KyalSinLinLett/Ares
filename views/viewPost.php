<!DOCTYPE html>
<html>
<head>
<title>View Post</title>
<link rel="stylesheet" type="text/css" href="profilepage/main.css">
</head>
<body>

<?php

	ob_start();
	session_start();

?>

<?php

include_once "../controller/postApi/getPost.php";
include_once "../controller/likeApi/getLikes.php";

?>

<button class="homebtn" type="button">
<a href="../index.php?name=<?php print_r($post_data['author']);?>">Go to feed</a>
</button>

<!-- show post content -->
<div class="card">
<p><b><?php print_r($post_data['title']);?></b></p>
<p><?php print_r($post_data['content']);?></p>
<p><?php print_r($post_data['posted_at']);?></p>
<p>Likes: <?php echo $likecount; ?></p>


<!-- Profile links based on logged in user -->
<?php
	//if the post author is the logged in user 
	if (isset($_SESSION['id'])){
		if (strcmp($_SESSION['id'], $post_data['posted_by']) == 0){

?>

	<p>Author: <a class="profilelinks" href="profile.php"><?php print_r($post_data['author']);?></a></p>

<?php
		
	} else {
?>

	<p>Author: <a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($post_data['posted_by'])?>"><?php print_r($post_data['author']);?></a></p>

<?php
		}
	} else {
?>

	<p>Author: <a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($post_data['posted_by'])?>"><?php print_r($post_data['author']);?></a></p>	

<?php
	}
?>

<!-- likes -->
<?php 
	
	//is user already logged in?
	if (isset($_SESSION['id'])){

		$id = $_SESSION['id'];

		// is this post already been liked by user?
		include_once "../controller/check_liked.php";
		if ($condition > 0){ //means already liked

		?>
			<!-- Show unlike button -->
			<button class="btn" type="button">
				<a href="../controller/likeApi/unlike.php?id=<?php echo $id;?>&user_id=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>">Unlike</a>
			</button>
			
		<?php
		} else {
		?>	
			<!-- show like button -->
			<button class="btn" type="button">
				<a href="../controller/likeApi/addLike.php?id=<?php echo $id;?>&user_id=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>">Like</a>
			</button>
			
		<?php
		}	
	}	

?>

<!-- show edit, delete buttons if user is logged in -->
<?php 

	if (isset($_SESSION['id'])){
		if ($post_data['posted_by'] == $_SESSION['id']){
	
?>

	<button class="btn" type="button">
		<a href="editPostPage.php?title=<?php print_r($post_data['title']);?>&content=<?php print_r($post_data['content']);?>&post_id=<?php print_r($post_data['post_id']);?>">Edit</a>
	</button>
	<button class="btn" type="button">
		<a href="../controller/postApi/deletePost.php?post_id=<?php print_r($post_data['post_id']); ?>">Delete</a>
	</button>

<?php

		}
	}

?>

</div>


<!-- Adding comments -->

<?php

if (isset($_SESSION['id'])){

?>

	<div class="card">
		<form action="../controller/cmtApi/addComment.php?user_id=<?php echo $_SESSION['id']; ?>&post_id=<?php print_r($post_data['post_id']);?>" method="POST">
			<input type="text" name="cmt" placeholder="Add a comment">
			<input type="submit" name="submit" value="Add">
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

	<div class="comment-card">
		<p>> <?php print_r($cmt_data['comment']);?></p>
		<p><?php print_r($cmt_data['posted_at']);?></p>
		
		
				
		<?php

			if (isset($_SESSION['id'])){
				if (strcmp($_SESSION['id'], $cmt_data['posted_by']) == 0){


		?>

				<a class="profilelinks" href="profile.php"><p><?php print_r($cmt_data['author'])?></p></a>

				<button class="btn" type="button">
				<a href="../controller/cmtApi/deleteComment.php?post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id'])?>&user_id=<?php print_r($_GET['user_id']); ?>">Delete</a>
				</button>

				<button class="btn" type="button">
				<a href="editCommentPage.php?post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id']);?>&cmt=<?php print_r($cmt_data['comment']);?>">Edit</a>
				</button>

		<?php

				} else {

		?>
			<a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($cmt_data['posted_by'])?>"><p><?php print_r($cmt_data['author']);?></p></a>
			 

			
		<?php
				}
			} else {
		?>

			<a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($cmt_data['posted_by'])?>"><p><?php print_r($cmt_data['author']);?></p></a>	

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