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
<h1 id=start>What would you like to do, <?= $uName ?>?</h1>
<body>
	<div id=mid class="row">
		<form action="./playerProjSelect.php" id="leftcol" class="col">
			<button class="first">Play</button>
		</form>
		<form action="./creatorProjSelect.php" id="rightcol" class="col">
			<button class="first">Create</button>
		</form>
	</div>
</body>
</html>
