<!DOCTYPE html>
<html>
<head>
<title>View Post</title>
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

?>

<?php

include_once "../controller/postApi/getPost.php";
include_once "../controller/likeApi/getLikes.php";

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

<!-- show post content -->
<div class="container" style="margin-top: 95px;">
	<h1 class="mb-3"><i><b>View Post</b></i></h1>
	<hr>
	<div class="card p-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
		<article>
			<h2><?php print_r($post_data['title']);?></h2>
			<p><?php print_r($post_data['content']);?></p>
		</article>


		<?php
			if ($post_data['postpics'] != null){ 
		?>	
			<div class="mb-4">
				<img style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);" src="../images/postpics/<?php print_r($post_data['postpics'])?>" width="280">
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
	 	<p><b>Likes:</b> <?php echo $likecount; ?></p>
		</i></small>
		

		<!-- Profile links based on logged in user -->
		<?php
			//if the post author is the logged in user 
			if (isset($_SESSION['id'])){
				if (strcmp($_SESSION['id'], $post_data['posted_by']) == 0){

		?>

			<p><i>Author: </i><a class="profilelinks" href="profile.php?user_id=<?php echo $_SESSION['id']?>"><?php print_r($post_data['author']);?></a></p>

		<?php
				
			} else {
		?>

			<p><i>Author: </i><a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($post_data['posted_by'])?>"><?php print_r($post_data['author']);?></a></p>

		<?php
				}
			} else {
		?>

			<p><i>Author: </i><a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($post_data['posted_by'])?>"><?php print_r($post_data['author']);?></a></p>	

		<?php
			}
		?>

		<hr>
		<div class="row pl-3">
				<!-- likes -->
				<?php 
					//is user already logged in?
					if (isset($_SESSION['id'])){

						$id = $_SESSION['id'];

						// is this post already been liked by user?
						include_once "../controller/check_liked.php";
						if ($condition > 0){ //means already liked

						?>
							<!-- Show unlike button -->
							<a style="color: red;" href="../controller/likeApi/unlike.php?id=<?php echo $id;?>&user_id=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>"><img src="img/unlike.png" class="mr-2 mt-2" style="width:35px;"></a>
							
						<?php
						} else {
						?>	
							<!-- show like button -->
							<a href="../controller/likeApi/addLike.php?id=<?php echo $id;?>&user_id=<?php print_r($post_data['posted_by'])?>&post_id=<?php print_r($post_data['post_id']);?>"><img src="img/like.png" class="mr-2 mt-2" style="width:35px;"></a>
							
						<?php
						}	
					}	

				?>

				<!-- show edit, delete buttons if user is logged in -->
				<?php 

					if (isset($_SESSION['id'])){
						if ($post_data['posted_by'] == $_SESSION['id']){

				?>
					<a href="editPostPage.php?title=<?php print_r($post_data['title']);?>&post_id=<?php print_r($post_data['post_id']);?>"><img src="img/editprofile.png" class="mr-2 mt-2 rounded-circle" style="width:35px;"></a>

					<a onClick="javascript: return confirm('Are you sure you want to delete?');" href="../controller/postApi/deletePost.php?post_id=<?php print_r($post_data['post_id']); ?>"><img src="img/delete.png" class="mr-2 mt-2" style="width:35px;"></a>

				<?php

						}
					}

				?>
		</div>
		<hr>
		<!-- Adding comments -->

		<form action="../controller/cmtApi/addComment.php?user_id=<?php echo $_SESSION['id']; ?>&post_id=<?php print_r($post_data['post_id']);?>" method="POST">
			<input class="form-control mr-sm-2 mb-2" type="text" name="cmt" placeholder="Add a comment (Max: 50)" required>
			<button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit">Comment</button>
		</form>
	</div>

	

	<?php

	if (isset($_SESSION['id'])){

	}

	?>

	<!-- Getting comments -->

	<?php

	include_once "../controller/cmtApi/getComments.php";

	$num_rows = $result->rowCount();

	if ($num_rows > 0){

		while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
			extract($rs);

			$cmt_data = array(
				"cmt_id" => $rs['cmt_id'],
				"comment" => $rs['comment'],
				"posted_at" => $rs['posted_at'],
				"posted_by" => $rs['posted_by'],
				"author" => $rs['name']
			);

	?>
		
		<div class="card p-4 mt-3 mb-4" style="border-radius: .5rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
			
			<p><img src="img/comments.png" style="width: 30px;">&nbsp&nbsp<?php print_r($cmt_data['comment']);?></p>		
					
				<?php

					if (isset($_SESSION['id'])){
						if (strcmp($_SESSION['id'], $cmt_data['posted_by']) == 0){
				?>

						<a class="profilelinks" href="profile.php?user_id=<?php echo $_SESSION['id']?>"><?php print_r($cmt_data['author'])?></a>		
						<small><i>
						<?php
					 		$datetime = $cmt_data['posted_at'];
					 		$date = explode(" ", $datetime);
					 		echo "posted on ".$date[0];
					 	?>
						</i></small>
						
						<hr>

						<div class="row pl-3">

							<a href="editCommentPage.php?post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id']);?>&cmt=<?php print_r($cmt_data['comment']);?>"><img src="img/editprofile.png" class="mr-2 mt-2 rounded-circle" style="width:35px;"></a>

							<a onClick="javascript: return confirm('Are you sure you want to delete?');" href="../controller/cmtApi/deleteComment.php?post_id=<?php print_r($post_data['post_id']);?>&cmt_id=<?php print_r($cmt_data['cmt_id'])?>&user_id=<?php echo $_SESSION['id']; ?>"><img src="img/delete.png" class="mr-2 mt-2" style="width:35px;"></a>
						
						</div>
						

				<?php
						} else {
				?>

					<a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($cmt_data['posted_by'])?>"><?php print_r($cmt_data['author']);?></a>
						<small><i>
						<?php
					 		$datetime = $cmt_data['posted_at'];
					 		$date = explode(" ", $datetime);
					 		echo "posted on ".$date[0];
					 	?>
						</i></small>
			
				<?php
						}
					} else {
				?>

					<a class="profilelinks" href="viewProfilePage.php?user_id=<?php print_r($cmt_data['posted_by'])?>"><?php print_r($cmt_data['author']);?></a>	
						<small><i>
						<?php
					 		$datetime = $cmt_data['posted_at'];
					 		$date = explode(" ", $datetime);
					 		echo "posted on ".$date[0];
					 	?>
						</i></small>

				<?php
					}
				?>					
		</div>

	<?php
		}
	} 
	?>
	
	<?php 
	
	ob_flush();
	
	?>
</div>

</body>
</html>