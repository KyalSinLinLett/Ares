<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	include("design/bootstrap.html");
?>	

</head>
<body>

<?php  

ob_start();
session_start();

?>


<!-- nf is user logged in -->
<?php
	
	if(isset($_SESSION['id'])){

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
			
	<!-- search -->
	<div class="container" style="margin-top: 95px;">
		<div>
			<form action="searchResults.php" method="POST" class="form-inline">
				<select name="search_by" class="browser-default custom-select">
				  <option>Post</option>
				  <option>User</option>
				</select>
			  <input name="s_query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
			  <button class="btn btn-outline-info my-2 my-sm-0" name="search" type="submit">Search</button>
			</form>
		</div>
		<!-- /search -->

		<div class="mt-3 mb-4">
			<h4>Welcome, <i><b><?php echo $_SESSION['name']; ?></b></i></h4>
			<p><i>Check out these posts.</i></p>
		</div>

	<?php
		include_once "../controller/postApi/getAllPostsNF.php";

		$num_rows = $result->rowCount();

		if ($num_rows > 0){

			while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
				extract($rs);

				$post_data = array(
					"post_id" => $rs['post_id'],
					"title" => $rs['title'],
					"content" => $rs['content'],
					"posted_at" => $rs['posted_at'],
					"name" => $rs['name'],
					"user_id" => $rs['id'],
					"profilepic" => $rs['profilepic']
				);

				include_once "../controller/likeApi/getLikesNF.php";

				$like->post_id = $post_data['post_id'];

				if ($likes = $like->get_likes()){
					$likecount = $likes['count(user_id)'];
				} else {
					echo "Cannot get post likes. Try again.";
				}

		?>

			<div class="media border p-3 mb-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
			  
			  <?php
			  		if ($post_data['profilepic'] != null){
			  ?>

			  		<?php
			  			if ($_SESSION['id'] == $post_data['user_id']){
			  		?>
			  				<a href="profile.php?user_id=<?php print_r($post_data['user_id'])?>"><img src="../images/profilepic/<?php echo $post_data['profilepic']?>" alt="<?php echo $post_data['name']?>" style="width: 50px; height: 50px; border-radius: 5rem; margin-right: 15px;"></a>	
			  		<?php
			  			} else {
			  		?>	
			  				<a href="viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><img src="../images/profilepic/<?php echo $post_data['profilepic']?>" alt="<?php echo $post_data['name']?>" style="width: 50px; height: 50px; border-radius: 5rem; margin-right: 15px;"></a>		
			  		<?php
			  			}
			  		?>
			  			
			  <?php
			  		} else {
			  ?>

			  			<?php
			  				if ($_SESSION['id'] == $post_data['user_id']){
			  			?>
			  					<a href="profile.php?user_id=<?php print_r($post_data['user_id'])?>"><img src="img/nfprofile.gif" alt="<?php echo $post_data['name']?>" style="width: 50px; height: 50px; border-radius: 5rem; margin-right: 15px;"></a>	
			  			<?php
			  				} else {
			  			?>	
			  					<a href="viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><img src="img/nfprofile.gif" alt="<?php echo $post_data['name']?>" style="width: 50px; height: 50px; border-radius: 5rem; margin-right: 15px;"></a>		
			  			<?php
			  				}
			  			?>
			  <?php
			  		}
			  ?>

			  
			  	<div class="media-body">
			    	<a href="viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>
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
			        <div>	
			    	    <?php
			    			if (strcmp($post_data['user_id'],$_SESSION['id'])==0){
			    		?>
			    			<small><i>Posted by me on </i></small>
			    		<?php
			    			} else {
			    		?>
			    				<small><i><a href="viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><?php print_r($post_data['name']);?></a> posted on </i></small>
			    		<?php
			    			}
			    		?>
			    		<small><i>
			    		<?php
			    	 		$datetime = $post_data['posted_at'];
			    	 		$date = explode(" ", $datetime);
			    	 		echo $date[0];
			    	 	?>
			    		</i></small>
			    	</div>
			    	<small>Likes: <?php echo $likecount?></small>
			 	</div>
			</div>

		
		<?php

			}

		} 

		?>

	<?php
 
} else {
	header("location: ../index.php");
	exit();
} 
ob_flush();
?>

</div>

</body>
</html>