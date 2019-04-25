<?php
include dirname(__DIR__, 1)."/objects/database.php";
include dirname(__DIR__, 1).'/objects/error.php';

class DatabaseAPI{
  private $conn;

  public function __construct($input){
    $database = new Database($input);
    $this->conn = $database->getConnection();
  }

  public function getUserPassword($uName){
    $findUser = "SELECT pWord FROM user WHERE uName = '$uName'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $error = new ErrorThrow("Error: mysqli_query error");
      return $error;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        $getQuery = mysqli_fetch_assoc($query); // Fetch Assoc Array
        $dbPW = $getQuery['pWord']; // Retrieve password from DB
        return $dbPW;
      }
      else{
        // Error return: No such user exists for given name
        $error = new ErrorThrow("Error: No such user exists for given name");
        return $error;
      }
    }
  }

  public function checkUsername($uName){
    $findUser = "SELECT uName FROM user WHERE uName = '$uName'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $error = new ErrorThrow("Error: mysqli_query error");
      return $error;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        return true;
      }
      else{
        return false;
      }
    }
  }

  public function removeUser($uName){
    if ($this->checkUsername($uName)){
      $findUser = "DELETE FROM user WHERE uName = '$uName'";
      $query = mysqli_query($this->conn, $findUser);

      if (!$query){ // If something went wrong with the query, return appropriate error
        // Error return: Unable to query DB
        $error = new ErrorThrow("Error: mysqli_query error");
        return $error;
      }
      else{
        return true;
      }
    }
    else {
      return false;
    }
  }

  public function createUser($uName, $pWord){
    $hash = password_hash($pWord, PASSWORD_DEFAULT);

    $addUser = "INSERT INTO user(uName, pWord) VALUES ('$uName', '$hash')";

    $query = mysqli_query($this->conn, $addUser);

    if (!$query){
      return new ErrorThrow("Error: mysqli_query error");
    }
    else{
      return true;
    }
  }

  public function createProject($projectName, $ownerID){
    $addProject = "INSERT INTO project(projectName, ownerID) VALUES ('$projectName', '$ownerID')";

    $query = mysqli_query($this->conn, $addProject);

    if (!$query){
      return new ErrorThrow("Error: mysqli_query error");
    }
    else{
      return true;
    }
  }

  public function removeProject($projectID){
    if ($this->checkUsername($uName)){
      $deleteProject = "DELETE FROM project WHERE projectID = " . $projectID;
      $query = mysqli_query($this->conn, $deleteProject);

      if (!$query){ // If something went wrong with the query, return appropriate error
        // Error return: Unable to query DB
        $error = new ErrorThrow("Error: mysqli_query error");
        return $error;
      }
      else{
        return true;
      }
    }
    else {
      return false;
    }
  }

  public function getAllPublishedProjects(){
    $findUser = "SELECT * FROM project WHERE isPublished = 1";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $error = new ErrorThrow("Error: mysqli_query error");
      return $error;
    }
    else{
        return $query;
    }
  }
}

?>
