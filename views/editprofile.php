<?php
ob_start();

include("design/bootstrap.html");
include("../codesnippets/ifsessionISNOTset.php");

?>
<title>Edit profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<div class="container" style="margin-top: 95px;">
	<div class="card p-4" style="border-radius: 1rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);">
		
		<?php
			include_once "../controller/userApi/getUser.php";	
		
			if ($profilepic != null){
		?>
				<div class="row ml-2">
					<img src="../images/profilepic/<?php echo $profilepic;?>" style="width: 100px; height: 100px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);border-radius: 5rem;">
				</div>
		<?php
			} else {
		?>
				<div class="row ml-2">
					<img src="img/nfprofile.gif" style="width: 100px; height: 100px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);border-radius: 5rem;">
				</div>
		<?php
			}
		?>

		<a href="changePP.php">Change profile pic</a>
		<hr>
		
		<form action="../controller/userApi/updateUser.php" method="post" enctype="multipart/form-data"	>

		
			<!-- edit profile text -->
			<b>Edit profile</b>
			<a href="newsfeed.php"><b style="font-style: italic;">Cancel</b></a>
			<hr>

			<!-- name text and input box -->
			<div>
				<b class="pt-5">Name</b>
				<input class="form-control mr-sm-2 mb-2" type="text" name="name" value="<?php echo $name; ?>" required>
			</div>

			<!-- Birthday text and date input box -->
			<div>
				<b>Birthday</b>
				<input class="form-control mr-sm-2 mb-2" type="date" name="birthday" value="<?php echo $birthday; ?>" required>
			</div>

			<!-- profession text and input box -->
			<div>
				<b>Profession</b>
				<input class="form-control mr-sm-2 mb-2"  type="text" name="profession" value="<?php echo $profession;?>" placeholder="i.e. Student" required>
			</div>

			<!-- Add bio text and input box -->
			<div>
				<b>Add bio</b>
				<textarea class="md-textarea form-control mb-2"name="bio" rows="5"  placeholder="A sentence describing yourself." required><?php echo $biography;?></textarea>
			</div>

			<hr>
			<!-- update button -->
			<div>
				<button class="btn btn-outline-info my-2 my-sm-0" name="submit" type="submit">Update Profile</button>
 			</div>
		</form>

		<br>

		<!-- more functions -->
		<div>
			<a href="changepasswordpage.php"><b style="font-style: italic;">Change password?</b></a>
		</div>
		<div>
			<a href="deleteaccount.php"><b style="font-style: italic;">Delete account?</b></a>
		</div>
	</div>
			
</div>

<?php 
ob_flush();
?>