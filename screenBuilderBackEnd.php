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
$obj =(json_decode($_POST["x"], false));
echo $_POST["x"];
$objNew = str_replace("{", "",$obj);
$objNew = str_replace("}", "",$objNew);
$inputArray = explode(":",$objNew);
$target = $inputArray[1];
//$obj.split
$stmt = $conn->prepare("SELECT * FROM .$target");
//$stmt->bind_param("s", $target);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($outp);



//$SQL = "SELECT * FROM book";
/*
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $conn->prepare($SQL); 
    //$stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(); 
	
	//if you want to know how many results came back
	$total = count($result);
	
	//Show the result on the webpage as a table (you can change it the way it is required)
	echo "<table style='border: solid 1px black;width:100%;'>";
	echo "<tr style='border: solid 1px black;'><th>ISBN</th><th>ISSN</th><th>Title</th>
		<th>Edition</th><th>Author</th><th>Publisher</th>
		<th>Price</th><th>Stock</th></tr>";
	
	foreach($result as $row){
		echo "<tr style='border: solid 1px black;'><th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th>
			<th>$row[4]</th><th>$row[5]</th><th>$row[6]</th><th>$row[7]</th></tr>";
	}

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "</table>";
$conn = null;

?>
below is a sample JSON object of a scene.
var scene = {id:"temp", image:"sample.jpg", option1:"This is option one",option2:"This is option 2",
option3:"This is option 3", option4: "this is option 4"};//JSON object
var scene =JSON.stringify(scene);
*/

//$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$stmt = $conn->prepare($SQL); 
//$stmt->execute();
	
	

//**************************EVERYTHING BELOW IS SCREEN BUILDER FUNCTIONS*******************************


//passOff takes info from ScreenBuilder.js and passes it to the database to be stored
//thinking it needs to return a T/F result if successful or failed
//function passOff(){
	
//}//end of passOff

//deleteScene finds a specific scene and its options and deletes it
//return T/F if successful of failed
//function deleteScene(){
	
//}//end of deleteScene	
	
//BGI takes a Image and overrides a scene's stored bacgkround image on the database
//function BGI(){
	/*update image
	from scene
	where sceneID = input
	*/
//}//end of BGI
?>