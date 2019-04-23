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
$obj =($_POST["x"]);
//echo $_POST["x"];
//get rid of the { and } characters
$objNew = str_replace("{", "",$obj);
$objNew = str_replace("}", "",$objNew);
//break remaining string into an array based on what was passed in
$inputArray = explode(";",$objNew);
$len = count($inputArray);
$currentScene="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$desc="";
$imagePath="";
$SQL;
switch ($len){
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
			$imagePath = str_replace('url("',"",$inputArray[3]);
			$imagePath=str_replace('")',"",$imagePath);
		}
		else if (stristr($inputArray[3],":"!=-1)){
			$desc = str_replace(":","",$inputArray[3]);
		}
		else{
			$opt3 = $inputArray[3];
		}
		break;
	case 5:
		$currentScene = $inputArray[0];
		$opt1 = $inputArray[1];
		$opt2 = $inputArray[2];
		if(stristr($inputArray[3],"/")!=-1){
			$imagePath = str_replace('url("',"",$inputArray[3]);
			$imagePath=str_replace('")',"",$imagePath);
		}
		else if (stristr($inputArray[3],":"!=-1)){
			$desc = str_replace(":","",$inputArray[3]);
		}
		else{
			$opt3 = $inputArray[3];
		}
		
		if(stristr($inputArray[4],"/")!=-1){
			$$imagePath = str_replace('url("',"",$inputArray[4]);
			$imagePath=str_replace('")',"",$imagePath);
		}
		else if (stristr($inputArray[4],":"!=-1)){
			$desc = str_replace(":","",$inputArray[4]);
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
		if (stristr($inputArray[4],":"!=-1)){
			$desc = str_replace(":","",$inputArray[4]);
			$imagePath = str_replace('url("',"",$inputArray[5]);
			$imagePath=str_replace('")',"",$imagePath);
		}
		else{
			$opt4 = $inputArray[4];
			if(stristr($inputArray[5],"/")!=-1){
				$imagePath = str_replace('url("',"",$inputArray[5]);
			$imagePath=str_replace('")',"",$imagePath);
			}
			else{
				$desc = str_replace(":","",$inputArray[5]);
			}
		}
		break;
	case 7:
		$currentScene=$inputArray[0];
		$opt1=$inputArray[1];
		$opt2=$inputArray[2];
		$opt3=$inputArray[3];
		$opt4=$inputArray[4];
		$desc=str_replace(":","",$inputArray[5]);
		$imagePath = str_replace('url("',"",$inputArray[6]);
			$imagePath=str_replace('")',"",$imagePath);
		break;
	default:
		//echo "Nothing was passed over";
}//end of switch case
$SQL = "SELECT optionID FROM options WHERE sceneID LIKE '$currentScene'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$result = $stmt->get_result();
$all="";
while($text = mysqli_fetch_assoc($result)){
   $all = $all ."+" .$text['optionID'];
}
$id = explode("+",$all);
$SQL="UPDATE `options` SET `oText`='$opt1' WHERE `options`.`optionID` ='$id[1]'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL="UPDATE `options` SET `oText`='$opt2' WHERE `options`.`optionID` ='$id[2]'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL="UPDATE `options` SET `oText`='$opt3' WHERE `options`.`optionID` ='$id[3]'";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL="UPDATE `options` SET `oText`='$opt4' WHERE `options`.`optionID` ='$id[4]'";
$stmt = $conn->prepare($SQL);
$stmt->execute();


if(empty($desc)&&empty($imagePath)){
	/* $SQL = "UPDATE `scene` SET `description`='$desc',imgDir='$imagePath' WHERE `sceneID` = '$currentScene'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute(); */
	//echo "1";
}
else if (empty($desc)){
	$SQL = "UPDATE `scene` SET `imgDir`='$imagePath' WHERE `sceneID` = '$currentScene'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute();
	//echo "2";
}
else if(empty($imagePath)){
	$SQL = "UPDATE `scene` SET `description`='$desc' WHERE `sceneID` = '$currentScene'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute(); 
	//echo "3";
}
else{
	$SQL = "UPDATE `scene` SET `description`='$desc',imgDir='$imagePath' WHERE `sceneID` = '$currentScene'";
	$stmt = $conn->prepare($SQL);
	$stmt->execute();
	//echo $SQL;
}
//$outp = $result->fetch_all(MYSQLI_ASSOC);
//echo json_encode($outp);
?>