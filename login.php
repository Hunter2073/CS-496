<?php

//much of this file is code from another project that is being retrofitted to this one
//as such, many comments are found throughout telling what is old / what needs to be changed

session_start();
$servername = "people.wku.edu";
$username = "kth81383";
$password = "nk4k9n8wR_yQTjjU";
$db_name = "gameenginedb";

//create conn
$conn = new mysqli($servername, $username, $password);

//check conn
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn, $db_name);

echo "Successful connection!";

$uID = $_POST['userID'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

/*

password hashing stuff goes here

*/


//old query
$findUser = "SELECT name, permission FROM user WHERE uID = '$uID' AND password = '$pWord'"; 

$query = mysqli_query($conn, $findUser);
$rows = mysqli_num_rows($query);

echo $rows;

if($rows == 1){
	$getQuery = mysqli_fetch_assoc($query);
	$permissionLevel = $getQuery['permission'];

	$_SESSION['permission'] = $permissionLevel; //probably wont need this
	$_SESSION['loggedin'] = true;
	$_SESSION['name'] = $getQuery['name'];

	header('Location: main.php'); //old
}
else{
	header('Location: login.php'); //old
}



?>