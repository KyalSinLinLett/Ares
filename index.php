<!DOCTYPE html>
<html>
<head>
	<title>Ares feed</title>
	<link rel="stylesheet" type="text/css" href="views/profilepage/main.css">
</head>
<body>
	
<?php  

ob_start();
session_start();

?>


<!-- nf if user is not logged in -->
<?php  
	
	if (!isset($_SESSION['id'])){

	?>

	<button class="btn" type="button">
		<a href='views/login.php'>Login here</a><br>
	</button>

	<button class="btn" type="button">
		<a href='views/signup.php'>Sign Up</a>
	</button>	

		<div class="welcome-card">
			<div>
				<p class="welcome">Welcome to ARES.</p>
			</div>

			<p class="site-information">Ares is a social network.</p>

			<p class="site-information">See what people are saying!</p>
		</div>

		<div class="card">
			<form action="views/searchResults.php" method="POST">
				<select name="search_by">
					<option>Post</option>
					<option>User</option>
				</select>
				<input type="text" name="s_query" placeholder="Search anything" required>
				<input type="submit" name="search" value="Search">
			</form>
		</div>

<?php
	include_once "controller/postApi/getAllPostsNF.php";

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
				"user_id" => $rs['id']
			);

	?>
		<div class="card">
			<a class="postlinks"href="views/viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><img class="smallprofilepic"src="https://i.cubeupload.com/8Hf7dq.png"><p><b><?php print_r($post_data['title']);?></b></p></a>
			<p><?php print_r($post_data['content']);?></p>
			<p><?php print_r($post_data['posted_at']);?></p>

			<p>Author: <a class="profilelinks" href="views/viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><?php print_r($post_data['name']);?></a></p>
			
		</div>
	
	<?php

		}

	} 

?>
		
<!-- nf is user logged in -->
<?php
} else {

?>
	<button class="btn" type="button">
		<a href='views/profile.php?user_id=<?php echo $_SESSION['id'];?>'>View your profile</a>
	</button>

	<button class="btn" type="button">
		<a href='controller/logout.php'>Log out</a>		
	</button>				

	<div class="welcome-card">
		<div>
			<p class="welcome">Welcome to your feed, <?php
				echo $_SESSION['name']; ?></p>
		</div>
		<div>
			<p class="site-information">Follow these folks!</p>
		</div>
	</div>

	<div class="card">
		<form action="views/searchResults.php" method="POST">
			<select name="search_by">
				<option>Post</option>
				<option>User</option>
			</select>
			<input type="text" name="s_query" placeholder="Search anything" required>
			<input type="submit" name="search" value="Search">
		</form>
	</div>

	<?php

		include_once "controller/postApi/getAllPostsNF.php";

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
					"user_id" => $rs['id']
				);

		?>
			<div class="card">
				
				<a class="postlinks" href="views/viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><img class="smallprofilepic" src="https://i.cubeupload.com/8Hf7dq.png"><p><b><?php print_r($post_data['title']);?></b></p></a>
				<p><?php print_r($post_data['content']);?></p>
				<p><?php print_r($post_data['posted_at']);?></p>
				 
				<?php
					if (strcmp($post_data['user_id'],$_SESSION['id'])==0){
						echo "<p>Posted by me</p>";
					} else {
				?>
						<p>Author: <a class="profilelinks" href="views/viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><?php print_r($post_data['name']);?></a></p>
				<?php
					}
				?>
			</div>
		
		<?php

			}

		} 

		?>

<?php

}

ob_flush();
?>

?>

</body>
</html>