<?php
if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin']==true && isset($_COOKIE['username']) ){

}
else {
  echo '<script type="text/javascript">';
  echo "alert(\"An error occured! You have to be logged in to access this page!\");";
  echo 'window.location.href = "../frontend/login.html";';
  echo '</script>';
}
?>
<html>
<script>
function createNew(){
window.location.href = "../frontend/createNewProject.php";
}
</script>
<link rel="stylesheet" href="../css/mycss.css">
<h1>Select a game to work on:</h1>



<body>
	<div id="body" class="row">
		<div id=leftcol class="col">
			<form action="scenebuilder.php" method="post">
				<?php
				include dirname(__DIR__, 1).'/backend/backendapi/backendapi.php';

				$backendapi = new BackendAPI(0);
				$allProjects = $backendapi->databaseapi->getAllProjects($_COOKIE['username']);

				if (!$allProjects->isError()){
					while($row = mysqli_fetch_assoc($allProjects->getResult())){
						echo "<input type=\"radio\" name=\"project\" value=\"" .$row['projectID']."\">" . $row['projectName'] . "</input></br>";
					}
				}
				?>
				<input type="submit">
			</form>
			<input type="button" value="Create New" id="createButton" onclick="createNew()">
		</div>
		<div id=rightcol class="col">
			<img src="../images/bookLogo.jpg" alt="Book Logo" id="thumb">
		</div>
	</div>
</body>
</html>
