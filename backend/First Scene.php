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
echo $_POST["x"];
$objNew = str_replace("{", "",$obj);
$objNew = str_replace("}", "",$objNew);
echo $objNew;
$target = $objNew;
//$obj.split
$stmt = $conn->prepare("SELECT firstSceneID FROM project WHERE projectID LIKE '.$target'");
//$stmt->bind_param("s", $target);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($outp);
?>