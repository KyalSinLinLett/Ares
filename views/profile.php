<!DOCTYPE html>
<html>
<head>
	<title>Your profile</title>
	<link rel="stylesheet" type="text/css" href="profilepage/main.css">
</head>
<body>
		<?php
			include_once '../controller/api/getUser.php';
		?>

		<div>
			<button class="homebtn" type="button">
				<a href="../index.php?name=<?php echo $name; ?>">Go to feed</a>
			</button>
			<div class="profile-card">


				<img src="https://i.cubeupload.com/8Hf7dq.png">

				<h1><?php echo $name; ?></h1>
				<p class='title'><?php echo $profession; ?></p>
				<div id="information">
					<p># <?php echo $biography; ?></p>
					<p># <?php echo $birthday; ?></p>
					<p># <?php echo $email; ?></p>
				</div>

				<div>
					<button class="btn" type="button">
						<a
							href="editprofile.php?
								name=<?php echo $name;?>
								&birthday=<?php echo $birthday;?>
								&profession=<?php echo $profession;?>
								&biography=<?php echo $biography;?>">
								Edit profile
						</a>
					</button>
				</div>
			</div>
		</div>

		<!-- Create post -->
		<div class="card">
			<p class="createpostinfo">Share something</p>
			<form action="../controller/postApi/createPost.php" method="POST">
				<input type="text" name="title" placeholder="Title">
				<input type="textares" name="content" placeholder="Share your thoughts">
				<input type="submit" name="submit" value="Create">
			</form>
		</div>


		<!-- Show posts -->
		<?php

			include_once "../controller/postApi/getAllPosts.php";

			$num_rows = $result->rowCount();

			if ($num_rows > 0){

				while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
					extract($rs);

					$post_data = array(
						"post_id" => $rs['post_id'],
						"title" => $rs['title'],
						"content" => $rs['content'],
						"posted_at" => $rs['posted_at'],
						"user_id" => $rs['user_id']
					);

			?>
				<div class="card">
					
					<a class="postlinks" href="viewPost.php?user_id=<?php print_r($post_data['user_id']);?>&post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>
					<p><?php print_r($post_data['content']);?></p>
					<p><?php print_r($post_data['posted_at']);?></p>
					<p style="font-style: italic;">Author: <?php echo $_SESSION['name'];?></p>

					<button class="btn" type="button">
						<a href="editPostPage.php?title=<?php print_r($post_data['title']);?>&content=<?php print_r($post_data['content']);?>&post_id=<?php print_r($post_data['post_id']);?>">Edit</a>
					</button>
					<button class="btn" type="button">
						<a href="../controller/postApi/deletePost.php?post_id=<?php print_r($post_data['post_id']); ?>">Delete</a>
					</button>
				</div>
			
			<?php

				}

			} 

			?>


</body>
</html>