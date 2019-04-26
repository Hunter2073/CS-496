<?php
include "backendapi/backendapi.php";

if (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin']==true && isset($_COOKIE['username']) ){

}
else {
  echo '<script type="text/javascript">';
  echo "alert(\"An error occured! You have to be logged in to access this page!\");";
  echo 'window.location.href = "../frontend/login.html";';
  echo '</script>';
}

if (isset($_POST['projectName']) && isset($_POST['projectDescription'])){
  $backendapi = new BackendAPI(0);
  $result = $backendapi->newProject($_COOKIE['username'], $_POST['projectName'], $_POST['projectDescription']);
  if ($result->isError()){
    echo '<script type="text/javascript">';
    echo "alert(\"An error occured! ".$result->getResult()."\");";
    echo 'window.location.href = "../frontend/login.html";';
    echo '</script>';
  }
  else{
    echo '<script type="text/javascript">';
    echo "alert(\"Project was successfully created\");";
    echo 'window.location.href = "../frontend/creatorProjSelect.php";';
    echo '</script>';
  }
}
else {
  echo '<script type="text/javascript">';
  echo "alert(\"An error occured! Something went wrong...\");";
  echo 'window.location.href = "../frontend/createOrPlay.php";';
  echo '</script>';
}









?>
