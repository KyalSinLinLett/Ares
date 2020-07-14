<!DOCTYPE html>
<html>
<head>
	<title>Followers</title>
<!-- 	<link rel="stylesheet" type="text/css" href="profilepage/main.css"> -->
</head>
<body>
		<button class="homebtn" type="button">
			<a href="newsfeed.php?user_id=<?php echo $_GET['nf']; ?>">Go to feed</a>
		</button>
		<hr>
		<div class="card">
			<table>
				<tr>
					<th>Followers</th>
				</tr>
					<?php  

					//showing followers and followings
					include_once "../controller/followerApi/getFollowerList.php";

					if ($num_rows > 0){
						while ($rs = $res->fetch(PDO::FETCH_ASSOC)){

					?>
					<tr>
						<td>
							<p><?php echo $rs['name']?></p>
						</td>
					</tr>
					<?php
						}
					}

					?>
			</table>
		</div>

</body>
</html>