<?php
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
$obj =(json_decode($_POST["x"], false));
//echo $_POST["x"];
$objNew = str_replace("{", "",$obj);
$objNew = str_replace("}", "",$objNew);
$inputArray = explode(":",$objNew);
$proj = $inputArray[0];
$scene = $inputArray[1];
$sql = "SELECT oText FROM options WHERE sceneID LIKE '$scene'";
//echo $sql;
$stmt = $conn->prepare($sql);
$stmt->execute();
$oText = $stmt->get_result();//gets all the oText
//$oText->fetch_all(MYSQLI_ASSOC);
$sql = "SELECT imgDir FROM scene WHERE sceneID LIKE '$scene'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$imgDir = $stmt->get_result();

//$text = $oText['oText'];
//echo $text;
$all = "";



while($text = mysqli_fetch_assoc($oText)){
   $all = $all ."+" .$text['oText'];
   //do shit with it here
}
while($text = mysqli_fetch_assoc($imgDir)){
   $all = $all ."+" .$text['imgDir'];
   //do shit with it here
}
//$outp = $all. "+".$imgDir;

echo json_encode($all); 




/* function fun($v1,$v2){
	return $v1. " " . $v2;
} */
?>