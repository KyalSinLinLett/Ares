<?php

ob_start();
include("design/bootstrap.html");
include("../codesnippets/ifsessionISNOTset.php");

?>

<!-- HTML contains PHP code -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit comment</title>

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
	<div class="card pl-4 pr-4 pt-4 pb-1" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
		<form action="../controller/cmtApi/updateComment.php?cmt_id=<?php echo $_GET['cmt_id'];?>&post_id=<?php echo $_GET['post_id']?>" method="post">

			<?php
				$old_comment = $_GET['cmt'];
				$cmt_id = $_GET['cmt_id'];
				$post_id = $_GET['post_id'];
			?>

			<!-- edit comment text -->
				Edit comment
				<a href="viewPost.php?post_id=<?php echo $post_id;?>"><b style="font-style: italic;">Cancel</b></a>
			<hr>
			<!-- input box for modified comment -->
			<div>
				<textarea class="md-textarea form-control mb-2" name="comment" rows="5" maxlength="10000" required><?php echo $old_comment; ?></textarea>	
			</div>
			<hr>
			<!-- edit button -->
			<div>
				<button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit">Edit</button>
			</div>
		</form>
	</div>
</div>

<?php 
ob_flush();
?>