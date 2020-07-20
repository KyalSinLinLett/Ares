<!DOCTYPE html>
<html>
<head>
	<title>Ares feed</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="design/main.css">
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

	<button class="btn" type="button">
		<a href="profile.php?user_id=<?php echo $_SESSION['id'];?>">View your profile</a>
	</button>

	<button class="btn" type="button">
		<a onclick="javascript: return confirm('Are you sure you want to log out?');" href='../controller/logout.php'>Log out</a>
	</button>				

	<div class="welcome-card">
		<div>
			<p class="welcome">Welcome to your feed, <i><b><?php
				echo $_SESSION['name']; ?></b></i></p>
		</div>
		<div>
			<p class="site-information">Follow these folks!</p>
		</div>
	</div>

	<div>
		<form action="searchResults.php" method="POST">
			<select name="search_by">
				<option>Post</option>
				<option>User</option>
			</select>
			<input type="text" name="s_query" maxlength="50" placeholder="Search anything" required>
			<input type="submit" name="search" value="Search">
		</form>
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
					"user_id" => $rs['id']
				);

		?>
			<div class="card">
				<?php
					if (strcmp($post_data['user_id'],$_SESSION['id'])==0){
						echo "<small>Posted by me</small>";
					} else {
				?>
						<small><a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><?php print_r($post_data['name']);?></a> made a post.</small>
				<?php
					}
				?>
				<hr>
				<a class="post-links" href="viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>
<!-- 				<p><?php //	print_r($post_data['content']);?></p>
 -->				<small><?php print_r($post_data['posted_at']);?></small>
				
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


</body>
</html>