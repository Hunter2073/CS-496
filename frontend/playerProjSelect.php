<html>
<link rel="stylesheet" href="../css/mycss.css">
<h1>Select a game</h1>

<div class="join">
	<input type="text" name="hostID" placeholder="hostID"><button name="join" id="join">Join?</button><br>
	<input type="checkbox">Host?<br><br>
</div>

<body>
	<div id="body" class="row">
		<div id=leftcol class="col">
			<form action="../backend/playgame.php" method="post">
				<?php
				include dirname(__DIR__, 1).'/backend/backendapi/backendapi.php';

				$backendapi = new BackendAPI(0);
				$allProjects = $backendapi->databaseapi->getAllPublishedProjects();

				if (!$allProjects->isError()){
					while($row = mysqli_fetch_assoc($allProjects->getResult())){
						echo "<input type=\"radio\" name=\"project\" value=\"" .$row['projectID']."\">" . $row['projectName'] . "</input></br>";
					}
				}
				?>
                <br><br>
				<input type="submit">
			</form>
		</div>
		<div id=rightcol class="col">
			<img src="../images/bookLogo.jpg" alt="Book Logo" id="thumb">
		</div>
	</div>
</body>
</html>
