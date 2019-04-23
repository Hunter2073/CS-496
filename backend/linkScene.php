<?php
//need to do some session cache to keep track of currently logged in user. 
//also if no user is currently logged into a session, prevent them from accessing the screen. Throw and error




/* $servername = "people.wku.edu";
$username = "kth81383";
$password = "nk4k9n8wR_yQTjjU";
$db_name = "gameenginedb"; */

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "local 496 project";

$conn = new mysqli("$servername", "$username", "$password", "$db_name");
if(! $conn ) {
	echo "Connection Failed";
}

header("Content-Type: application/json; charset=UTF-8");
$obj =($_POST["x"]);
//echo $obj;
$objNew = explode(":",$obj);
$option = $objNew[0];
$sceneTarget=$objNew[1];
$currentScene=$objNew[2];
$stmt = $conn->prepare("SELECT `optionID` FROM `options` WHERE `sceneID` LIKE '$currentScene'");
$stmt->execute();
$result = $stmt->get_result();
$optionIDs = "";
$i=0;
while($text = mysqli_fetch_assoc($result)){
   $optionIDs = $optionIDs ."+" .$text['optionID'];
}
$IDArray = explode("+",$optionIDs);
$ID = $IDArray[$option];
//$SQL="UPDATE `options` SET `nextSceneID` = '$sceneTarget' WHERE `options`.`optionID` = '$ID'";
$stmt = $conn->prepare("UPDATE `options` SET `nextSceneID` = '$sceneTarget' WHERE `options`.`optionID` = '$ID'");
$stmt->execute();
//$result = $stmt->get_result();
//echo $SQL;
//echo ($result);