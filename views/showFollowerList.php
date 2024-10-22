<!DOCTYPE html>
<html>
<head>
	<title>Followers</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include("design/bootstrap.html")?>
</head>
<body>
    
        <?php
            session_start();
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

			<h1 class="mb-3"><i><b>Followers</b></i></h1>
			<hr>

			<?php  
			//showing followers and followings
			include_once "../controller/followerApi/getFollowerList.php";

			if ($num_rows >= 0){
				while ($rs = $res->fetch(PDO::FETCH_ASSOC)){

			?>

				<div class="card ml-2 mb-3" style="border-radius: 3rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
					<div class="row">
				
						<?php	
							if (isset($_SESSION['id'])){
								//if user has set a profile pic
								if ($rs['profilepic'] != null){
									//if the user is the currently logged in user
									if (strcmp($_SESSION['id'], $rs['id'])==0){
						?>
									<a href="profile.php?user_id=<?php echo $rs['id']?>"><img src="../images/profilepic/<?php echo $rs['profilepic'];?>" alt="John Doe" class="ml-2 mr-3 rounded-circle"  width="70" height="70"></a>
								
						<?php
									} else {
						?>		
									<a href="viewProfilePage.php?user_id=<?php echo $rs['id']?>"><img src="../images/profilepic/<?php echo $rs['profilepic'];?>" alt="John Doe" class="m1-2 mr-3 rounded-circle"  width="70" height="70"></a>
						<?php
									}
								} else {
										if (strcmp($_SESSION['id'], $rs['id'])==0){
							?>
										<a href="profile.php?user_id=<?php echo $rs['id']?>"><img src="img/profilepic.gif" alt="John Doe" class="ml-2 mr-3 rounded-circle" width="70"></a>
									
							<?php
										} else {
							?>		
										<a href="viewProfilePage.php?user_id=<?php echo $rs['id']?>"><img src="img/profilepic.gif" alt="John Doe" class="m1-2 mr-3 rounded-circle" width="70"></a>
							<?php
										}
								}
							} 
						?>

						<b style="padding-top: 20px;"><?php echo $rs['name']?></b>
						
					</div>
				</div>
			<?php

				}
			} else {
				header('Location: ../index.php');
			}

			?>
		</div>

</body>
</html>