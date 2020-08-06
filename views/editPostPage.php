<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<?php
	ob_start();
	include("design/bootstrap.html");
	include("../codesnippets/ifsessionISNOTset.php");
	include("../controller/postApi/getPostContent.php");

	$title = isset($_GET['title']) ? $_GET['title'] : die();
	$content = $cont['content'];
	$postpics = $cont['postpics'];
	$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : die(); 

	?>

	<!-- Navbar -->
	<div>
		<nav class="mb-4 navbar navbar-expand-md bg-dark navbar-dark fixed-top">
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
		        <a class="nav-link" href="notifications.php"><img src="img/notibell.gif" alt="noti" style="margin-right: 2px; border-radius: 4rem; width: 34px; height: 32px;"><i> Notifications</i></a>
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

	<div class="container" style="margin-top: 95px;">
		<div class="card p-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">

			<form action="../controller/postApi/editPost.php?post_id=<?php echo $post_id;?>" method="post">

				<b>Edit post</b>
				<a href="viewPost.php?user_id=<?php echo $_SESSION['id']?>&post_id=<?php echo $post_id; ?>"><b style="font-style: italic;">Cancel</b></a>
				<hr>
	
				<!-- Title -->
				<b>Title</b>
				<input class="form-control mr-sm-2 mb-3 mt-1" type="text" name="title" maxlength="50" value="<?php echo $title; ?>" required>

				<!-- Content -->
				<div>
					<b>Content</b>
					<textarea class="md-textarea form-control mb-3 mt-1" name="content" maxlength="10000" rows="5" required><?php echo $content;?></textarea>
				</div>

				<?php
					if ($postpics != null){
				?>
						<b>Photo</b>
						<div>
							<img style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" src="../images/postpics/<?php echo $postpics;?>" width="270">
						</div> 

						<div class="mt-2">
							<a onClick="javascript: return confirm('Are you sure you want to delete?');" href="../controller/postApi/removePic.php?title=<?php echo $title; ?>&post_id=<?php echo $post_id;?>">Remove photo</a>
							<a href="changePhoto.php?title=<?php echo $title; ?>&post_id=<?php echo $post_id;?>">Change photo</a>
						</div>
				<?php
					} else {
				?>
					<div class="mt-2">
						<a href="addPhoto.php?title=<?php echo $title; ?>&post_id=<?php echo $post_id;?>">Add photo</a>
					</div>
				<?php
					}
				?>
				

				<hr>
				<!-- Edit button -->
				<div>
					<button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit">Edit</button>
				</div>
			</form>
		</div>
	</div>

	<?php
		ob_flush();
	?>

</body>
</html>