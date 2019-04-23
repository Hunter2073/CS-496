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
$inputArray = explode(":",$objNew);
$len = count($inputArray);
$proj="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$desc="";
$imagePath="";
$name="";
$SQL="";
//echo $obj;
/* switch ($len){
	case 2:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		break;
	case 3:
		$proj = $inputArray[0];
		$name = $inputArray[1];
		if(stristr($inputArray[2],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[2]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else{
			$desc = $inputArray[2];
		}
		break;
	case 4:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		if(stristr($inputArray[2],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[2]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else if(stristr($inputArray[2],":"!=-1){
			$desc = $inputArray[3];
		}
		else if(stristr($inputArray[3],":"!=-1){
			$desc = $inputArray[3];
		}
		else{
			opt1=$inputArray[2];
			opt2=$inputArray[3];
		}
		break;
	case 5:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		opt1=$inputArray[2];
		opt2=$inputArray[3];
		if(stristr($inputArray[4],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[4]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else{
			$desc = $inputArray[4];
		}
		break;
	case 6:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		opt1=$inputArray[2];
		opt2=$inputArray[3];
		if(stristr($inputArray[4],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[4]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else if(stristr($inputArray[4],":"!=-1){
			$desc = $inputArray[4];
		}
		else{
			$opt3=$inputArray[4];
		}
		
		if(stristr($inputArray[5],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[5]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else if(stristr($inputArray[5],":"!=-1){
			$desc = $inputArray[5];
		}
		else{
			$opt4=$inputArray[5];
		}
		break;
	case 7:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		opt1=$inputArray[2];
		opt2=$inputArray[3];
		opt3=$inputArray[4];
		if(stristr($inputArray[5],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[5]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else if(stristr($inputArray[5],":"!=-1){
			$desc = $inputArray[5];
			$imagePath = str_replace('url("','',$inputArray[6]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else{
			$opt4=$inputArray[5];
		}
		if(stristr($inputArray[6],"/")!=-1){
			$imagePath = str_replace('url("','',$inputArray[6]);
			$imagePath = str_replace('")','',$imagePath);
		}
		else{
			$desc = $inputArray[6];
		}
		break;
	case 8:
		$proj=$inputArray[0];
		$name=$inputArray[1];
		opt1=$inputArray[2];
		opt2=$inputArray[3];
		opt3=$inputArray[4];
		opt4=$inputArray[5];
		$desc = $inputArray[6];
		$imagePath = str_replace('url("','',$inputArray[7]);
		$imagePath = str_replace('")','',$imagePath);
	default:
		echo "Nothing was passed over";
}//end of switch case */
$proj=$inputArray[0];
$name=$inputArray[1];
$opt1=$inputArray[2];
$opt2=$inputArray[3];
$opt3=$inputArray[4];
$opt4=$inputArray[5];
$desc = $inputArray[6];
$imagePath = str_replace('url("','',$inputArray[7]);
$imagePath = str_replace('")','',$imagePath);
$SQL = "INSERT INTO `scene` (`projectID`, `description`, `SceneTitle`,`imgDir`) VALUES ('$proj','$desc','$name','$imagePath')";
$stmt = $conn->prepare($SQL);
$stmt->execute();


$SQL="SELECT * FROM scene ORDER BY sceneID DESC LIMIT 1";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$result = $stmt->get_result();
$all="";
while($text = mysqli_fetch_assoc($result)){
   $all = $all .$text['sceneID'];
   //do shit with it here
}
$SQL = "INSERT INTO `options` (`sceneID`,`oText`) VALUES ('$all','$opt1')";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL = "INSERT INTO `options` (`sceneID`,`oText`)VALUES('$all','$opt2')";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL = "INSERT INTO `options` (`sceneID`,`oText`)VALUES('$all','$opt3')";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$SQL = "INSERT INTO `options` (`sceneID`,`oText`)VALUES('$all','$opt4')";
$stmt = $conn->prepare($SQL);
$stmt->execute();
echo $all;
//$outp = $result->fetch_all(MYSQLI_ASSOC);
//echo json_encode($outp);
?>