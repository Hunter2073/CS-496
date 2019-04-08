<?php

$servername = "people.wku.edu";
$username = "kth81383";
$password = "nk4k9n8wR_yQTjjU";
$db_name = "gameenginedb"; 

/* $servername = "localhost";
$username = "root";
$password = "";
$db_name = "gameenginedb"; */

//create conn
$conn = new mysqli($servername, $username, $password);

//check conn
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn, $db_name);

echo "Successful connection!";

$getLastID = "SELECT MAX(uID) FROM user";

$query = mysqli_query($conn, $getLastID);
$getQuery = mysqli_fetch_assoc($query);

$nextID = $getQuery['uID'] + 1;

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

$hash = password_hash($pWord, PASSWORD_DEFAULT);

$addUser = "INSERT INTO user(uName, pWord, uID) VALUES ('$uName', '$hash', '$nextID')";

$query = mysqli_query($conn, $addUser);


?>