<!DOCTYPE html>
<html>
<head>
	<title>Visit</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		include("design/bootstrap.html");
	?>	
</head>
<body>

<!-- Get user information from API -->
<?php
	
	ob_start();
	session_start();
	if (!isset($_SESSION['id'])){
	    header("Location: ../index.php");
	    exit();
	}

	include_once '../controller/userApi/visitProfile.php';
?>

<!-- Navbar -->
<div>
	<nav class="mb-5 navbar navbar-expand-md bg-dark navbar-dark fixed-top">
	  <!-- Brand -->
	  <a class="navbar-brand" href="newsfeed.php"><img src="img/letterD.gif" alt="Logo" style="width:50px;"><i> d3v-overfl0w</i></a>

	  <!-- Toggler/collapsibe Button -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <!-- Navbar links -->
	  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="profile.php?user_id=<?php echo $_SESSION['id'];?>"><img src="img/profileDefault.gif" alt="profile" style="width:35px; height: 30px;"> <i>My profile</i></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="about.php"><img src="img/about.gif" alt="profile" style="width:35px; height: 30px;"><i> About</i></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" onclick="javascript: return confirm('Are you sure you want to log out?');" href='../controller/logout.php'><img src="img/logout.gif" alt="profile" style="width:40px; height: 30px;">  <i>Log out</i></a>
	      </li>
	    </ul>
	  </div>
	</nav> 
</div>
<!-- /navbar -->

<!-- display the information in HTML -->
<div class="container" style="margin-top: 95px;">
	<!-- card -->
	<div class="card p-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">

		<?php 
			if ($profilepic != null){
		?>
				<div>
					<img src="../images/profilepic/<?php echo $profilepic?>" style="border-radius: 6rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" width="200" height="200">
				</div>
		<?php
			} else {
		?>		
				<div>
					<img src="img/profilepic.gif" style="border-radius: 6rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" width="200" height="200">
				</div>
		<?php
			}
		?>
		<div class="ml-3 mt-4">
			<h1><?php echo $name; ?></h1>	
			<p><i><?php echo $biography; ?></i></p>
		</div>
		
		<hr>
		
		<div>
			<p><i><img src="img/profession.gif" alt="profession" class="mr-2 mt-2 rounded-circle" style="width:60px;"><?php echo $profession; ?></i></p>
			<p><i><img src="img/birthday.gif" alt="birthday" class="mr-2 mt-2 rounded-circle" style="width:60px; height: 55px;"><?php echo $birthday; ?></i></p>
			<p><i><img src="img/email.gif" alt="email" class="mr-2 mt-2 rounded-circle" style="width:65px;"><?php echo $email; ?></i></p>
		</div>



<!-- following function -->

		<!-- if logged in - show all -->

		<?php 


		$user_id = $_GET['user_id'];
		$followed_by = isset($_SESSION['id']) ? $_SESSION['id'] : "";


		//showing followers and followings
		include_once "../controller/followerApi/getFollowerCount.php";
		include_once "../controller/followerApi/getFollowingCount.php";
		
		?>

		<table class="table">
			<tr>
				<th>Followers</th>
				<th>Following</th>
			</tr>
			<tr>
				<td><a href="showFollowerList.php?user_id=<?php echo $user_id;?>"><p style="color: #008CBA;font-style: italic;"><?php echo $follower_count; ?></p></a></td>
				<td><a href="showFollowingList.php?user_id=<?php echo $user_id;?>"><p style="color: #008CBA;font-style: italic;"><?php echo $following_count; ?></p></a></td>
			</tr>
		</table>

		<?php
			if (isset($_SESSION['id'])){
				include_once "../controller/followerApi/followValidate.php";
			?>

			<?php
				if ($condition > 0){ //does this user already follow this account?
			?>
				<!-- show unfollow button -->
				<button class="btn btn-outline-danger" type="button">
					<a style="color: red;" href="../controller/followerApi/unfollowUser.php?user_id=<?php echo $user_id?>&followed_by=<?php echo $followed_by?>">Unfollow</a>
				</button>	
			<?php
				} else {
			?>
				<!-- show follow button -->
				<button class="btn btn-outline-info" type="button">
					<a href="../controller/followerApi/followUser.php?user_id=<?php echo $user_id?>&followed_by=<?php echo $followed_by?>">Follow</a>
				</button>
			<?php
				}
			}
		?>
	</div>

	<hr>

	<!-- Show posts -->
	<?php

	include_once "../controller/postApi/getPostForOtherUser.php";

	//set the user id
	$post->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

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
				"user_id" => $rs['user_id'],
				"postpics" => $rs['postpics']
			);

	?>
		<div class="media border p-4 mb-3" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
			<div class="media-body">
				
				<a href="viewPost.php?user_id=<?php print_r($post_data['user_id']);?>&post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>

				<!-- getting the content and date from post data array -->
				<p><i>
					<?php 
						$content = $post_data['content'];
						if (strlen($content) <= 70){
							echo $content;
						} else {
							$content_len_half = strlen($content)/4;
							for ($i = 0; $i <= $content_len_half; $i++){
								echo $content[$i];
							}
							echo "...";
					?>
						<small><a href="viewPost.php?post_id=<?php print_r($post_data['post_id']);?>">read more</a></small>
				
					<?php
						}
					?>	
				</i></p>

				<?php
					if ($post_data['postpics'] != null){ 
				?>	
					<div>
						<img style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" src="../images/postpics/<?php print_r($post_data['postpics'])?>" width="250">
					</div>	
				<?php
					} 
				?>


				<small><i>
				<?php
			 		$datetime = $post_data['posted_at'];
			 		$date = explode(" ", $datetime);
			 		echo "Posted on ".$date[0];
			 	?>
				</i></small>
				<br>
				<?php
					include_once "../controller/likeApi/getLikesNF.php";

					$like->post_id = $post_data['post_id'];

					if ($likes = $like->get_likes()){
						$likecount = $likes['count(user_id)'];
					} else {
						echo "Cannot get post likes. Try again.";
					}
				?>

				<small><i>Likes: <?php echo $likecount;?></i></small>

			</div>
		</div>
		<hr>

	<?php

		}

	} 

	ob_flush();

	?>

</div>

</body>
</html>