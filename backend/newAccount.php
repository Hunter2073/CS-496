<?php
// Include Database Objects
include_once 'backendapi/backendapi.php';
error_reporting(E_ERROR | E_PARSE); // removes unwanted warnings

$backendapi = new BackendAPI(0);

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

$bool = $backendapi->newAccount($uName, $pWord);

if (!$bool->isError()){
	echo '<script type="text/javascript">';
	echo "alert(\"Successful Account Creation\");";
	echo 'window.location.href = "../frontend/login.html";';
	echo '</script>';
}
else{
	echo '<script type="text/javascript">';
  echo "alert(\"An error occured! " . $bool->getError() ."\");";
  echo 'window.location.href = "../frontend/login.html";';
  echo '</script>';
}
?>
