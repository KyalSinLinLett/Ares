<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- 	<link rel="stylesheet" type="text/css" href="profilepage/main.css"> -->
</head>
<body>
	<?php 
		
		ob_start();
		session_start();

		include_once "../controller/search.php";

		$num_rows = $result->rowCount();

		if ($num_rows > 0){
			while ($rs = $result->fetch(PDO::FETCH_ASSOC)){
				if ($_POST['search_by'] == "Post"){
		?>
			<div class="card">
				<p><a style="color: #008CBA;" href="viewPost.php?post_id=<?php echo $rs['post_id']?>"><?php echo $rs['title']?></a></p>
				<p><?php echo $rs['content']?></p>
			</div>
		<?php
				} else {
		?>
				<hr>
				<div class="card">
					
					<?php	
						if (isset($_SESSION['id'])){
							if (strcmp($_SESSION['id'], $rs['id'])==0){
					?>
							<p><a style="color: #008CBA;" href="profile.php?user_id=<?php echo $rs['id']?>"><?php echo $rs['name']?></a></p>
							
					<?php
							} else {
					?>		
							<p><a style="color: #008CBA;" href="viewProfilePage.php?user_id=<?php echo $rs['id']?>"><?php echo $rs['name']?></a></p>
					<?php
							}
						} 
					?>
					
					<p><?php echo $rs['biography']?></p>
				</div>
				<hr>
		<?php		
				}
			}
		} else {
		?>

			<div class="card">
				<p>No results found. <a style="color: #008CBA;" href="newsfeed.php">Try again</a></p>
			</div>

		<?php
		}
		ob_flush();
	?>
</body>
</html>