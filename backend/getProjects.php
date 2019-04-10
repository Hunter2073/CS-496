<?php
include_once 'objects/database.php';

$database = new Database(0); //localhost
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

echo "Successful connection!"; //replace with api stuff

$query = "SELECT projectName, projectID FROM project WHERE isPublished = 1";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
	$projList = mysqli_fetch_assoc($result);
	//prepare project list as object to send to next file
	$_SESSION['projList'] = $projList;
	header('Location: ../frontend/playerProjSelect.php'); 
	/* while($row = mysqli_fetch_assoc($result)){
		//$projects = $row["projectName"];
		echo	"<form action=>
					<button class='". $row["projectID"] ."' onclick ='play()'>". $row["projectName"] ."</button>
				</form>
				";
	} */
	
}
else{
	//no projects found
	
}


?>