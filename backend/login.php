<?php

// Begin Session
session_start();
// Include Database Objects
include_once 'objects/database.php';
error_reporting(E_ERROR | E_PARSE); // Removes unwanted warnings

// Create Database Connection
$database = new Database(0); //LocalHost DB
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

// Retrieve user input from front end caller
$uName = $_POST['username'];
$pWord = $_POST['password'];

if ($uName == null || $pWord == null){
	// Failure message is sent back w/ appropriate info
}
else { //Valid information from caller
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
			$getQuery = mysqli_fetch_assoc($query); // Fetch Assoc Array
			$dbPW = $getQuery['pWord']; // Retrieve password from DB
			if (password_verify($pWord, $dbPW)){ // Compare the given and retrieved passwords, if verified
				// Set session variables appropriately
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $getQuery['uName'];
				// Success message is sent back here w/ appropriate info
				echo "success";
			} else{
				// Failure message is sent back here w/ appropriate info
				echo "Failed";
			}

if($rows == 1){
//	$getQuery = mysqli_fetch_assoc($query);
	//$permissionLevel = $getQuery['permission'];

		}
		else{
			// Failure message is sent back here w/ appropriate info
			echo "No such user exists";
			//header('Location: login.php'); //old
		}
	}
}
?>
