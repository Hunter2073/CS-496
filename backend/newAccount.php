<?php
// Include Database Objects
include_once 'backendapi/backendapi.php';
error_reporting(E_ERROR | E_PARSE); // removes unwanted warnings

$databaseapi = new BackendAPI(0);

$uName = $_POST['username'];
$pWord = $_POST['password']; //need to make sure the field names here are correct before testing

$bool = $databaseapi->newAccount($uName, $pWord);

if (is_bool($bool)){
	echo '<script type="text/javascript">';
  echo "alert(\"Successful Account Creation\");";
  echo 'window.location.href = "../frontend/login.html";';
  echo '</script>';
}
if (strcmp(get_class($bool), "ErrorThrow")==0){
  //redirect to login page w/ error message
  echo '<script type="text/javascript">';
  echo "alert(\"An error occured! " . $bool->getErrorMsg() ."\");";
  echo 'window.location.href = "../frontend/login.html";';
  echo '</script>';
}



?>
