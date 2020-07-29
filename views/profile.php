	<!DOCTYPE html>
<html>
<head>
<title>Your profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	include("design/bootstrap.html");
?>	
</head>
<body>
<?php
	
	ob_start();
	session_start();
	if (!isset($_SESSION['id'])){
	    header('Location: ../index.php');
	    exit();
	}

	include_once '../controller/userApi/getUser.php';
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
	      <li class="nav-item active">
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

<!-- Show user info -->
<div class="container" style="margin-top: 95px;">
	<!-- card -->
	<div class="card pl-4 pr-4 pt-4 pb-1" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
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
			<h1><?php echo $name; ?><a href="editprofile.php"><img src="img/editprofile.png" class="mr-2 mt-2 rounded-circle" style="float: right; width:35px;"></a></h1>	
			<p><i><?php echo $biography; ?></i></p>
		</div>		
		<hr>
		<div>
			<p><i><img src="img/profession.gif" alt="profession" class="mr-2 mt-2 rounded-circle" style="width:60px;"><?php echo $profession; ?></i></p>
			<p><i><img src="img/birthday.gif" alt="birthday" class="mr-2 mt-2 rounded-circle" style="width:60px; height: 55px;"><?php echo $birthday; ?></i></p>
			<p><i><img src="img/email.gif" alt="email" class="mr-2 mt-2 rounded-circle" style="width:65px;"><?php echo $email; ?></i></p>
		</div>

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
	</div>
	<!-- /card -->	

	<!-- Create post -->
	<div class="card p-4 mt-3 mb-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
		<p><i>Share something</i></p>
		<form action="../controller/postApi/createPost.php" method="POST" enctype="multipart/form-data">
			<input class="form-control mr-sm-2 mb-3" type="text" name="title" maxlength="50" placeholder="Title" required>
			<textarea  class="md-textarea form-control mb-2" rows="5" name="content" maxlength="10000" placeholder="Share your thoughts" required></textarea>
			<b>Add photo</b>	
			<input class="mb-3" type="file" name="postpics" accept="image/*"><br>
			<button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit">Create</button>
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

				<div>
					<small><i>Likes: <?php echo $likecount;?></i></small>
				</div>

				<br>
				<a href="editPostPage.php?title=<?php print_r($post_data['title']);?>&post_id=<?php print_r($post_data['post_id']);?>"><img src="img/editprofile.png" class="mr-2 mt-2 rounded-circle" style="width:35px;"></a>

				<a href="viewPost.php?post_id=<?php print_r($post_data['post_id']); ?>"><img src="img/delete.png" class="mr-2 mt-2" style="width:35px;"></a>
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