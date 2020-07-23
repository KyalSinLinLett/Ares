<!DOCTYPE html>
<html>
<head>
	<title>About</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	include("design/bootstrap.html");
	ob_start();
	session_start();
?>	
</head>
<body>
	<!-- Navbar -->
	<div>
		<nav class="mb-3 navbar navbar-expand-md bg-dark navbar-dark">
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
		      <li class="nav-item active">
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

	<div class="container">
		<article>
			<p style="font-family: ubuntu;">> d3v-overfl0w is a <i>small</i> and simple social network for sharing thoughts and knowledge.</p>
			<p style="font-family: ubuntu;">> It's mainly built with pure <i>PHP</i> without any frameworks and designed with Bootstrap 4.</p>	
			<p style="font-family: ubuntu;">> This site doesn't store cookies and your session is ended once you've logged out.</p>	
			<p style="font-family: ubuntu;">> Hope you enjoy it!</p>		
		</article>
		<a target="_blank" href="https://github.com/KyalSinLinLett"><img style="width: 40px;" src="img/githublogo.png"></a> <small>< Check out my GitHub</small>
	</div>
<?php
	ob_flush();
?>
</body>
</html>