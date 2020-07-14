<!DOCTYPE html>
<html>
<head>
<title>Your profile</title>
<!-- <link rel="stylesheet" type="text/css" href="profilepage/main.css"> -->
</head>
<body>
<?php
	
	ob_start();

	include_once '../controller/userApi/getUser.php';
?>

<!-- Show user info -->
<div>
	<button class="homebtn" type="button">
		<a href="newsfeed.php?user_id=<?php echo $_GET['user_id']?>">Go to feed</a>
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

		<hr>

		<?php 

		$user_id = $_GET['user_id'];

		//showing followers and followings
		include_once "../controller/followerApi/getFollowerCount.php";
		include_once "../controller/followerApi/getFollowingCount.php";
		
		?>


		<div>
			<table>
				<tr>
					<th>Followers</th>
					<th>Following</th>
				</tr>
				<tr>
					<td><a href="showFollowerList.php?nf=<?php echo $_GET['user_id'];?>&user_id=<? echo $user_id;?>"><p style="color: #008CBA;font-style: italic;"><?php echo $follower_count; ?></p></a></td>
					<td><a href="showFollowingList.php?nf=<?php echo $_GET['user_id'];?>&user_id=<? echo $user_id;?>"><p style="color: #008CBA;font-style: italic;"><?php echo $following_count; ?></p></a></td>
				</tr>
			</table>
		</div>
		<hr>
		<div>
			<button class="btn" type="button">
				<a
					href="editprofile.php?user_id=<?php echo $_GET['user_id']?>
						&name=<?php echo $name;?>
						&birthday=<?php echo $birthday;?>
						&profession=<?php echo $profession;?>
						&biography=<?php echo $biography;?>">
						Edit profile
				</a>
			</button>
		</div>
	</div>
</div>
<hr>

<!-- Create post -->
<div class="card">
	<p class="createpostinfo">Share something</p>
	<form action="../controller/postApi/createPost.php" method="POST">
		<input type="text" name="user_id" value="<?php echo $_GET['user_id']?>" readonly>
		<input type="text" name="title" placeholder="Title" required>
		<input type="textares" name="content" placeholder="Share your thoughts" required>
		<input type="submit" name="submit" value="Create">
	</form>
</div>
<hr>

<!-- Show posts -->
<?php

include_once "../controller/postApi/getAllPosts.php";

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
			
			<a class="postlinks" href="viewPost.php?

				user_id=<?php print_r($post_data['user_id']);?>
				&post_id=<?php print_r($post_data['post_id']);?>">

				<p><b><?php print_r($post_data['title']);?></b></p>

			</a>

			<!-- getting the content and date from post data array -->
			<p><?php print_r($post_data['content']);?></p>
			<p><?php print_r($post_data['posted_at']);?></p>

			<!-- get author name from session -->
			<p style="font-style: italic;">
				Author: <?php echo $name?>
			</p>

<!-- 			<button class="btn" type="button">
				<a href="editPostPage.php?title=<?php //print_r($post_data['title']);?>
					&post_id=<?php //print_r($post_data['post_id']);?>">
					Edit
				</a>
			</button>
			<button class="btn" type="button">
				<a 

				onClick="javascript: return confirm('Please comfirm deletion');"

				href="../controller/postApi/deletePost.php?user_id=<?php //echo $_GET['user_id']; ?>&post_id=<?php //print_r($post_data['post_id']); ?>">

					Delete

				</a>
			</button> -->
		</div>
		<hr>
	
<?php

	}

} 

ob_flush();

?>


</body>
</html>