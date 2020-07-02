<!DOCTYPE html>
<html>
<head>
	<title>Ares feed</title>
	<link rel="stylesheet" type="text/css" href="views/profilepage/main.css">
</head>
<body>
	
	<?php  

		session_start();

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
						<a class="postlinks"href="views/viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>
						<p><?php print_r($post_data['content']);?></p>
						<p><?php print_r($post_data['posted_at']);?></p>
						<p>Author: <a class="profilelinks" href="views/viewProfilePage.php?user_id=<?php print_r($post_data['user_id'])?>"><?php print_r($post_data['name']);?></a></p>
						
					</div>
				
				<?php

					}

				} 

				?>

		<?php
		} else {

		?>
			<button class="btn" type="button">
				<a href='views/profile.php'>View your profile</a>
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
						<a class="postlinks" href="views/viewPost.php?post_id=<?php print_r($post_data['post_id']);?>"><p><b><?php print_r($post_data['title']);?></b></p></a>
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

		?>
		



	

	?>




</body>
</html>