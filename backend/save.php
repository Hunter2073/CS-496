<?php
/* $servername = "people.wku.edu";
$username = "kth81383";
$password = "nk4k9n8wR_yQTjjU";
$db_name = "gameenginedb"; */

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "local 496 sample";

//establish connection to database
$conn = new mysqli("$servername", "$username", "$password", "$db_name");
if(! $conn ) {
	echo "Connection Failed";
}


//header is required to tell PHP what is coming its way
header("Content-Type: application/json; charset=UTF-8");
//decode JSON file
$obj =(json_decode($_POST["x"], false));
//echo $_POST["x"];
//get rid of the { and } characters
$objNew = str_replace("{", "",$obj);
$objNew = str_replace("}", "",$objNew);
//break remaining string into an array based on what was passed in
$inputArray = explode(":",$objNew);
var len = $inputArray.length();
$currentScene;
$opt1;
$opt2;
$opt3;
$opt4;
$imagePath;
$SQL;
switch (len){
	case 2:
		$opt1 = $inputArray[0];
		$opt2 = $inputArray[1];
		break;
	case 3:
		$currentScene = $inputArray[0];
		$opt1 = $inputArray[1];
		$opt2 = $inputArray[2];
		break;
	case 4:
		$currentScene = $inputArray[0];
		$opt1 = $inputArray[1];
		$opt2 = $inputArray[2];
		if(stristr($inputArray[3],"/")!=-1){
			$imagePath = $inputArray[3];
		}
		else{
			$opt3 = $inputArray[3];
		}
		break;
	case 5:
		$currentScene = $inputArray[0];
		$opt1 = $inputArray[1];
		$opt2 = $inputArray[2];
		$opt3 = $inputArray[3];
		if(stristr($inputArray[4],"/")!=-1){
			$imagePath = $inputArray[4];
		}
		else{
			$opt4 = $inputArray[4];
		}
		break;
	case 6:
		$currentScene=$inputArray[0];
		$opt1=$inputArray[1];
		$opt2=$inputArray[2];
		$opt3=$inputArray[3];
		$opt4=$inputArray[4];
		$imagePath=$inputArray[5];
	default:
		echo "Nothing was passed over";
}//end of switch case
$SQL = "SELECT optionID FROM options WHERE sceneID LIKE '.$currentScene'"
$stmt = $conn->prepare($SQL);
$stmt->execute();
$result = $stmt->get_results();
for ($i=0;$i<count($result)-1;$i++){
	$SQL = "UPDATE oText FROM options WHERE optionID LIKE '.$result[$i]'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute();
}
$SQL = "UPDATE imgDir FROM scene WHERE sceneID LIKE '.$currentScene'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
//$outp = $result->fetch_all(MYSQLI_ASSOC);
//echo json_encode($outp);
?>