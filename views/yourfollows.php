<!DOCTYPE html>
<html>
<head>
	<title>Notifications</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		include("design/bootstrap.html");
		ob_start();
		session_start();
	?>	
</head>
<body>
	<!-- Navbar -->
	<div>
		<nav class="mb-3 navbar navbar-expand-md bg-dark navbar-dark">
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
		      <li class="nav-item active">
		        <a class="nav-link" href="yourfollows.php"><img src="img/notibell.gif" alt="noti" style="margin-right: 2px; border-radius: 4rem; width: 34px; height: 32px;"><i> Notifications</i></a>
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

	<div class="container">
		<h1 class="mb-3"><i><b>Notifications</b></i></h1>
		<hr>

 		<div>
 			<ul class="nav nav-tabs nav-justified">
 			  <li class="nav-item">
 			    <a class="nav-link" href="notifications.php">Likes</a>
 			  </li>
 			  <li class="nav-item">
 			    <a class="nav-link active" href="yourfollows.php">Follows</a>
 			  </li>
 			  <li class="nav-item">
 			    <a class="nav-link" href="yourcomments.php">Comments</a>
 			  </li>
 			</ul>
 		</div>

		<h4 class="mt-3"><i>See who <b>followed</b> you recently. &#128062</i></h4>
		<hr>

		<?php
			include_once "../controller/followerApi/getFollowNotif.php";

			$num_rows = $res->rowCount();

			if ($num_rows > 0){
				while ($rs = $res->fetch(PDO::FETCH_ASSOC)){
				
			?>

				<div class="media border p-3 mb-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">

					<a href="viewProfilePage.php?user_id=<?php echo $rs['FOLLOWER']; ?>"><img src="../images/profilepic/<?php echo $rs['profilepic'];?>" alt="John Doe" class="mr-3 mt-2 rounded-circle" width="55" height="50"></a>
					

					<div class="media-body mt-1">
						<div>
							<small>
								<a href="viewProfilePage.php?user_id=<?php echo $rs['FOLLOWER']; ?>"><?php echo $rs['NAME'];?></a> started following you.
							</small>
						</div>
						
						<small><i>
							<?php
						 		$datetime = $rs['TIME_FOLLOWED'];
						 		$date = explode(" ", $datetime);
						 		echo $date[0];
						 	?>
						</i></small>
					</div>
				</div>

			<?php
					
				}
			}

			
		?>


		</div>

	</div>

</body>
</html>