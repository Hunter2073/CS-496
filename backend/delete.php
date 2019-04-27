<?php
/* $servername = "people.wku.edu";
$username = "kth81383";
$password = "nk4k9n8wR_yQTjjU";
$db_name = "gameenginedb"; */

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "local 496 project";

//establish connection to database
$conn = new mysqli("$servername", "$username", "$password", "$db_name");
if(! $conn ) {
	echo "Connection Failed";
}
//header is required to tell PHP what is coming its way
header("Content-Type: application/json; charset=UTF-8");
//decode JSON file
$obj =(json_decode($_POST["x"], false));
//echo $objNew;
//SELECT sceneID, SceneTitle FROM `scene` WHERE projectID  = 1;
$SQL = "DELETE FROM `scene` WHERE sceneID LIKE $obj";
//echo $SQL;
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL = "DELETE FROM `options` WHERE sceneID LIKE $obj";
$stmt = $conn->prepare($SQL);
$stmt->execute();
?>