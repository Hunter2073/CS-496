<html>
<link rel="stylesheet" href="../css/mycss.css">
<h1>Select a game to work on:</h1>



<body>
	<div id="body" class="row">
		<div id=leftcol class="col">
			<form action="scenebuilder.php" method="post">
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
				<input type="submit">
			</form>
		</div>
		<div id=rightcol class="col">
			<img src="../images/bookLogo.jpg" alt="Book Logo" id="thumb">
		</div>
	</div>
</body>
</html>
