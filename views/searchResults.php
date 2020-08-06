<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php 
include("design/bootstrap.html");
session_start();
ob_start();
?>
</head>
<body>
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
		<h1 class="mb-3"><i><b>Search results</b></i></h1>
		<hr>
		<?php 

		include_once "../controller/search.php";

		if ($result != null){
		
		$num_rows = $result->rowCount();

			if ($num_rows > 0){
				while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
					if ($_POST['search_by'] == "Post"){
			?>


				<div class="media border p-3 mb-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">

					<img src="img/profilepic.gif" alt="John Doe" class="mr-3 mt-2 rounded-circle" style="width:60px;">

					<div class="media-body">
						<a href="viewPost.php?post_id=<?php echo $rs['post_id']?>"><b><?php echo $rs['title']?></b></a>
						<p><i>
							<?php 
								$content = $rs['content'];
								if (strlen($content) <= 70){
									echo $content;
								} else {
									$content_len_half = strlen($content)/4;
									for ($i = 0; $i <= $content_len_half; $i++){
										echo $content[$i];
									}
									echo "...";
							?>
								<small><a href="viewPost.php?post_id=<?php print_r($rs['post_id']);?>">read more</a></small>
						
							<?php
								}
							?>	
						</i></p>
					</div>

				</div>
				<hr>


			<?php
					} else {
			?>

					<div class="media border p-3 mb-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">

						<?php
							if ($rs['profilepic'] != null){
						?>
								<img src="../images/profilepic/<?php echo $rs['profilepic']?>" alt="John Doe" class="mr-3 mt-2 rounded-circle" width="60" height="60">
						<?php
							} else {
						?>
								<img src="img/profilepic.gif" alt="John Doe" class="mr-3 mt-2 rounded-circle" style="width:60px;">
						<?php
							}
						?>
						<div class="media-body">
							<?php	
								if (isset($_SESSION['id'])){
									if (strcmp($_SESSION['id'], $rs['id'])==0){
							?>
									<a href="profile.php?user_id=<?php echo $rs['id']?>"><b><?php echo $rs['name']?></b></a>
									
							<?php
									} else {
							?>		
									<a href="viewProfilePage.php?user_id=<?php echo $rs['id']?>"><b><?php echo $rs['name']?></b></a>
							<?php
									}
								} 
							?>
							
							<p><i>
								<?php 
									$bio = $rs['biography'];
									if (strlen($bio) <= 100){
										echo "<small><i>".$bio."</i></small>";
									} else {
										$bio_len_half = strlen($bio)/4;
										for ($i = 0; $i <= $bio_len_half; $i++){
											echo "<small><i>".$bio[$i]."</i></small>";
										}
										echo "...";
									}
								?>	
							</i></p>

							<small>
								<i><b>Joined </b>
									<?php 
									$datetime = $rs['created_at'];
			    	 				$date = explode(" ", $datetime);
			    	 				echo $date[0];?>
								</i>
							</small>
						</div>
					</div>
					<hr>

			<?php		
					}
				}
			} else {
			?>

				<div>
					<p>No results found. <a style="color: #008CBA;" href="newsfeed.php">Try again</a></p>
				</div>

			<?php
			}

		}
		ob_flush();
		?>
	</div>
</body>
</html>