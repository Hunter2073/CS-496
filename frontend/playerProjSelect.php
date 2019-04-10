<html>
<link rel="stylesheet" href="../css/mycss.css">
	<h1>Select a game</h1>
<!--so need to make a call to the database, or file system to find out how many projects there are to generate...
how many bullet points are needed-->

	<div class="join">
			<input type="text" name="hostID" placeholder="hostID"><button name="join" id="join">Join?</button><br>
            <input type="checkbox">Host?<br><br>
		</div>

	<body>
		<div id="body" class="row">
			<div id=leftcol class="col">
				<?php
				include dirname(__DIR__, 1).'/backend/backendapi/backendapi.php';

				$backendapi = new BackendAPI(0);

				//test data
				$projectName = "testProject";
				$ownerID = 6;

				$backendapi->databaseapi->createProject($projectName, $ownerID);

				$allProjects = $backendapi->databaseapi->getAllPublishedProjects();

				while($row = mysqli_fetch_assoc($allProjects)){
				   echo "<button class=\"select\">" . $row['projectName']."</button>";
				}
				 ?>
			</div>
			<div id=rightcol class="col">
				<img src="../images/bookLogo.jpg" alt="Book Logo" id="thumb">
			</div>
		</div>
	</body>
</html>
