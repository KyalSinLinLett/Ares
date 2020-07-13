<!DOCTYPE html>
<html>
<head>
	<title>Followers</title>
<!-- 	<link rel="stylesheet" type="text/css" href="profilepage/main.css"> -->
</head>
<body>
		<button class="homebtn" type="button">
			<a href="newsfeed.php?name=<?php echo $name; ?>">Go to feed</a>
		</button>
		<hr>
		<div class="card">
			<table>
				<tr>
					<th>Followers</th>
				</tr>
					<?php  

					session_start();

					//showing followers and followings
					include_once "../controller/followerApi/getFollowerList.php";

					if ($num_rows > 0){
						while ($rs = $res->fetch(PDO::FETCH_ASSOC)){

					?>
					<tr>
						<td>
							<?php
								if (isset($_SESSION['id'])){
									if (strcmp($_SESSION['id'], $rs['id']) == 0){

								?>
									<a href="profile.php?user_id=<?php echo $rs['id']?>"><p style="color: #008CBA;font-style: italic;"><?php echo $rs['name']; ?></p></a>


							<?php

									} else {

							?>

									<a href="viewProfilePage.php?user_id=<?php echo $rs['id']?>"><p style="color: #008CBA;font-style: italic;"><?php echo $rs['name']; ?></p></a>

							<?php

									}
								} else {
									header('Location: signup.php');
								}

							?>

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