<?php 

	include_once "../dbconnector/Database.php";
	include_once "../models/Search.php";

	//instantiate db
	$database = new Database();
	$db = $database->connect();

	//instantiate post object
	$search = new Search($db);

	if (isset($_POST['search'])){

		$search->s_query = $_POST['s_query'];
			
		if ($search->s_query != "';--" && $search->s_query != "admin'--" && $search->s_query != ";" &&  $search->s_query != "' UNION SELECT 1, 'anotheruser', 'doesnt matter', 1--"){

			if (strcmp($_POST['search_by'], "User")==0){
				$result = $search->search_user();
			} else if (strcmp($_POST['search_by'], "Post")==0){
				$result = $search->search_post();
			}

		} else {

			$result = null;
			echo "
			<div>
				<p>No results found. <a style='color: #008CBA;' href='newsfeed.php'>Try again</a></p>
			</div>";
		}
		

	}

	


?>