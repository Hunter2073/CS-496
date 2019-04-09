<?php
// Include Database Objects
include_once 'objects/database.php';
error_reporting(E_ERROR | E_PARSE); // removes unwanted warnings

// Create Database Connection
$database = new Database(1); //LocalHost DB
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

if ($uName == null || $pWord == null){
	// Failure message is sent back w/ appropriate info
}
else { //Valid information from caller

  // Authenticate username + pword against requirements

	// Query to retrieve user information
	$findUser = "SELECT uName, pWord FROM user WHERE uName = '$uName'";

	// Make the query to the DB
	$query = mysqli_query($conn, $findUser);

	if (!$query){ // If something went wrong with the query, return appropriate error
		printf("Errormessage: %s\n", mysqli_error($conn));
	}
	else {
		$rows = mysqli_num_rows($query); // Find number of rows retrieved

		// If the user exists, only ONE row should be returned, else user does not exist.
		if($rows == 1){
	    // User already exists
	    // Failure message is sent back w/ appropriate info
	    echo "Failure: User Already Exists";
		}
		else{
	    // User does not already exist. Therefore can be created.
	    $hash = password_hash($pWord, PASSWORD_DEFAULT);

	    $addUser = "INSERT INTO user(uName, pWord) VALUES ('$uName', '$hash')";

	    $query = mysqli_query($conn, $addUser);
		}
	}
}



?>
