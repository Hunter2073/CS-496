<?php
include_once 'objects/database.php';

$database = new Database(0); //LocalHost DB
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

echo "Successful connection!"; //replace with api stuff

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

// Should we be validating the password/username provided here before placing it into the DB?
// If so, we need to come up with requirements for them

// 1. Check to see if Username already exists
//   if true -> return alreadyExistsErr
//   else -> following logic:

$hash = password_hash($pWord, PASSWORD_DEFAULT);

$addUser = "INSERT INTO user(uName, pWord) VALUES ('$uName', '$hash')";

$query = mysqli_query($conn, $addUser);


?>
