<?php
	$uName = "ERROR";
	if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin']==true){
		if (isset($_COOKIE['username'])){
			$uName = $_COOKIE['username'];
		}
	}
	else {
		echo '<script type="text/javascript">';
		echo "alert(\"An error occured! You have to be logged in to access this page!\");";
		echo 'window.location.href = "../frontend/login.html";';
		echo '</script>';
	}
?>

<html>
<link rel="stylesheet" href="../css/mycss.css">
<h1 id=start>Create a New Project:</h1>
<body>
	<div id=mid class="row">
		<form method="POST" action="../backend/createNewProject.php" id="leftcol" class="col">
        <label>Project Name: <input type="text" name="projectName" maxlength="16" required></label></br>
        <label>Project Description: <input type="text" name="projectDescription" maxlength="255"></label></br>
        <input type="submit">
		</form>
	</div>
</body>
</html>
