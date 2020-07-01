<!DOCTYPE html>
<html>
<head>
	<title>Visit</title>
	<link rel="stylesheet" type="text/css" href="profilepage/main.css">
</head>
<body>

		<?php
			include_once '../controller/api/visitProfile.php';

			//get user id
			$user->id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

			//perform a get user query
			$user = $user->get_user();	

			$name = $user['name'];
			$email = $user['email'];
			$birthday = $user['birthday'];
			$profession = $user['profession'];
			$biography = $user['biography'];
		?>

		<div>
			<button class="homebtn" type="button">
				<a href="../index.php">Back to feed</a>
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
			</div>
		</div>

		<!-- Show posts -->
		<?php

			include_once "../controller/postApi/getPostForOtherUser.php";

			//set the user id
			$post->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

			//set the result to $rs
			$result = $post->get_all_posts();

			$num_rows = $result->rowCount();

			if ($num_rows > 0){

				while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
					extract($rs);

					$post_data = array(
						"post_id" => $rs['post_id'],
						"title" => $rs['title'],
						"content" => $rs['content'],
						"posted_at" => $rs['posted_at']
					);

			?>
				<div class="card">
					<p><b><?php print_r($post_data['title']);?></b></p>
					<p><?php print_r($post_data['content']);?></p>
					<p><?php print_r($post_data['posted_at']);?></p>
					<p style="font-style: italic;">Author: <?php echo $name;?></p>
				</div>
			
			<?php

				}

			} 

			?>


</body>
</html>