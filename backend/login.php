<?php

//much of this file is code from another project that is being retrofitted to this one
//as such, many comments are found throughout telling what is old / what needs to be changed

session_start();
include_once 'objects/database.php';

$database = new Database(0); //LocalHost DB
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

echo "Successful connection!";

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing




//old query
$findUser = "SELECT uName, pWord FROM user WHERE uName = '$uName'";

// Need error handling if this fails
$query = mysqli_query($conn, $findUser);
$rows = mysqli_num_rows($query);

echo $rows;

$getQuery = mysqli_fetch_assoc($query);

$dbPW = $getQuery['pWord'];
$hash = password_hash($pWord, PASSWORD_DEFAULT);
//echo $hash . "\n";
//echo $dbPW;

if (password_verify($pWord, $dbPW)){
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $getQuery['uName'];
	echo "success"; //replace with api stuff
	header('Location: ../frontend/creatorProjSelect.html');
} else{
	echo "Failed"; //replace with api stuff
	header('Location: ../frontend/login.html'); 
}

//	header('Location: main.php');




?>
