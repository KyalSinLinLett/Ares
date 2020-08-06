<!DOCTYPE html>
<html>
<head>
<title>Change photo</title>
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
	include("../controller/postApi/getPostContent.php");


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
	<!-- card -->
	<div class="card p-5" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
		
		<p>Change photo  <a href="editPostPage.php?title=<?php echo $_GET['title']; ?>&post_id=<?php echo $_GET['post_id'];?>"><b style="font-style: italic;">Cancel</b></a></p>
		
		<hr>

		<form action="../controller/postApi/changePic.php?title=<?php echo $_GET['title'];?>&post_id=<?php echo $_GET['post_id'];?>" method="POST" enctype="multipart/form-data">
			
			<?php
				$postpics = $cont['postpics'];
				if ($postpics != null){
			?>	
				<b>Current photo</b><br>
				<img style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" src="../images/postpics/<?php echo $postpics; ?>" width="250">
			<?php
				}
			?>
			<hr>
			<b>Select new photo</b>
			<input class="mt-2" name="postpics" type="file" accept="image/*" required>
			<div class="mt-3 mb-2">
				<button class="btn btn-success my-2 my-sm-0" name="submit" type="submit">Change</button>
 			</div>

			<div>
				<small><i>#Square photos recommended</i></small>		
			</div>
		</form>
	</div>
</div>

		
<?php ob_flush(); ?>

</body>
</html>