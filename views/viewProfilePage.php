<!DOCTYPE html>
<html>
<head>
	<title>Visit</title>
<!-- 	<link rel="stylesheet" type="text/css" href="profilepage/main.css">
 --></head>
<body>

<!-- Get user information from API -->
<?php
	
	ob_start();
	session_start();

	include_once '../controller/userApi/visitProfile.php';
?>

<!-- display the information in HTML -->
<div>
	<button class="homebtn" type="button">
		<a href="newsfeed.php?user_id=<?php echo $_GET['user_id']?>">Back to feed</a>
	</button>
	<hr>
	<div class="profile-card">
		<h1><?php echo $name; ?></h1>
		<p class='title'><?php echo $profession; ?></p>
		<div id="information">
			<p># <?php echo $biography; ?></p>
			<p># <?php echo $birthday; ?></p>
			<p># <?php echo $email; ?></p>
		</div>



<!-- following function -->

		<!-- if logged in - show all -->

		<?php 

		$user_id = $_GET['posted_by'];
		
		// $posted_by = $_GET['posted_by'];
		// $user_id = $_GET['user_id']; //the logged in user for nf
		//showing followers and followings
		include_once "../controller/followerApi/getFollowerCount.php";
		include_once "../controller/followerApi/getFollowingCount.php";
		
		?>

		<hr>
		<div>
			<table>
				<tr>
					<th>Followers</th>
					<th>Following</th>
				</tr>
				<tr>
					<td><a href="showFollowerList.php?nf=<?php echo $_GET['user_id']?>&user_id=<? echo $_GET['posted_by'];?>"><p style="color: #008CBA;font-style: italic;"><?php echo $follower_count; ?></p></a></td>
					<td><a href="showFollowingList.php?nf=<?php echo $_GET['user_id']?>&user_id=<? echo $_GET['posted_by'];?>"><p style="color: #008CBA;font-style: italic;"><?php echo $following_count; ?></p></a></td>
				</tr>
			</table>
		</div>


		<?php
				include_once "../controller/followerApi/followValidate.php";
			?>

			<?php

				
				$followed_by = $_GET['user_id'];
				if ($condition > 0){ //does this user already follow this account?
			?>
				<!-- show unfollow button -->
				<button class="btn" type="button">
					<a href="../controller/followerApi/unfollowUser.php?user_id=<?php echo $user_id?>&followed_by=<?php echo $followed_by?>">Unfollow</a>
				</button>	
			<?php
				} else {
			?>
				<!-- show follow button -->
				<button class="btn" type="button">
					<a href="../controller/followerApi/followUser.php?user_id=<?php echo $user_id?>&followed_by=<?php echo $followed_by?>">Follow</a>
				</button>
			<?php
				}
		?>
	</div>
</div>
<hr>

<!-- Show posts -->
<?php

include_once "../controller/postApi/getPostForOtherUser.php";

//set the user id
$post->user_id = isset($_GET['posted_by']) ? $_GET['posted_by'] : die();

//set the result to $rs
$result = $post->get_all_posts();

$num_rows = $result->rowCount();

if ($num_rows > 0){

	while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
		extract($rs);

		$post_data = array(
			"post_id" => $rs['post_id'],
			"title" => $rs['title'],
			"content" => $rs['content'],
			"posted_at" => $rs['posted_at'],
			"user_id" => $rs['user_id']
		);

?>
	<div class="card">
		<a class="postlinks" href="viewPost.php?user_id=<?php echo $_GET['user_id']?>		&posted_by=<?php echo $_GET['posted_by'];?>
				&post_id=<?php print_r($post_data['post_id']);?>">

				<p><b><?php print_r($post_data['title']);?></b></p>
		</a>


		<p><?php print_r($post_data['content']);?></p>
		<p><?php print_r($post_data['posted_at']);?></p>

		<p style="font-style: italic;">Author: <?php echo $name;?></p>
	</div>
	<hr>	

<?php

	}

} 

ob_flush();

?>


</body>
</html>