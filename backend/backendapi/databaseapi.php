<?php
include dirname(__DIR__, 1)."/objects/database.php";
include dirname(__DIR__, 1).'/objects/result.php';


class DatabaseAPI{
  private $conn;

  public function __construct($input){
    $database = new Database($input);
    $this->conn = $database->getConnection();
  }

  // ******** USER FUNCTIONS ********

  /* getUserPassword(string):
  parameter: valid username
  returns:
   - Error if the query fails
   - String if supplied a valid username
   - False bool if username does not exist
  */
  public function getUserPassword($uName){
    $result = new Result();
    $findUser = "SELECT pWord FROM user WHERE uName = '$uName'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("DatabaseAPI Error: mysqli_query error");
      return $result;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        $getQuery = mysqli_fetch_assoc($query); // Fetch Assoc Array
        $dbPW = $getQuery['pWord']; // Retrieve password from DB
        $result->setResult($dbPW);
        return $result;
      }
      else{
        // Error return: No such user exists for given name
        //$result->setError("DatabaseAPI Error: No such user exists for given name");
        $result->setResult(false);
        return $result;
      }
    }
  }
  /* checkUsername(string):
  parameter: valid username
  returns:
   - Error if the query fails
   - true bool if supplied an existing username
   - false bool if supplied a username that does not exist
  */
  public function checkUsername($uName){
    $result = new Result();
    $findUser = "SELECT uName FROM user WHERE uName = '$uName'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("DatabaseAPI Error: mysqli_query error");
      return $result;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        $result->setResult(true);
        return $result;
      }
      else{
        $result->setResult(false);
        return $result;
      }
    }
  }
  /* removeUser(string):
  parameter: valid username
  returns:
   - Error if the query fails
   - true bool if the removal succeeds
   - Error if the username does not exist
   - Error if the checkUsername call returns an error
  */
  public function removeUser($uName){
    $result = new Result();
    $doesUserExist = $this->checkUsername($uName);
    if ((!$doesUserExist->getError()) && (($doesUserExist->getResult())==true)){
      $findUser = "DELETE FROM user WHERE uName = '$uName'";
      $query = mysqli_query($this->conn, $findUser);

      if (!$query){
        $result->setError("DatabaseAPI Error: mysqli_query error");
        return $result;
      }
      else{
        $result->setResult(true);
        return $result;
      }
    }
    else if ((!$doesUserExist->getError()) && (($doesUserExist->getResult())==false)){
      $result->setError("DatabaseAPI Error: username does not exist, and cannot be deleted from DB");
      return $result;
    }
    else{
      return $doesUserExist;
    }
  }
  /* createUser(string, string):
  parameter: valid username, valid password
  returns:
   - Error if the query fails
   - true bool if the creation succeeds
   - Error if the username is already taken
   - Error if the checkusername call returns an error
  */
  public function createUser($uName, $pWord){
    $result = new Result();
    $hash = password_hash($pWord, PASSWORD_DEFAULT);

    $addUser = "INSERT INTO user(uName, pWord) VALUES ('$uName', '$hash')";

    $doesUserExist = $this->checkUsername($uName);

    if (!$doesUserExist->isError() && $doesUserExist->getResult()==false){
      $query = mysqli_query($this->conn, $addUser);

      if (!$query){
        $result->setError("DatabaseAPI Error: mysqli_query error");
        return $result;
      }
      else{
        $result->setResult(true);
        return $result;
      }
    }
    else if (!$doesUserExist->isError() && $doesUserExist->getResult()==true){
      $result->setError("DatabaseAPI Error: Username is already taken");
      return $result;
    }
    else {
      return $doesUserExist;
    }
  }
  // QUESTION:: do we need to find out all of the things linked to this user and delete them as well?

  public function getUserID_Username($uName){
    $result = new Result();
    $findUser = "SELECT uID FROM user WHERE uName = '$uName'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("DatabaseAPI Error: mysqli_query error");
      return $result;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        $uID = mysqli_fetch_assoc($query);
        $result->setResult($uID["uID"]);
        return $result;
      }
      else{
        $result->setError("DatabaseAPI Error: Duplicate UName in DB");
        return $result;
      }
    }
  }
  // ******** PROJECT FUNCTIONS ********

  /* createProject(string, int)
  parameters: valid project name, valid ownerID
  returns:
   - error if query fails
   - true if creation succeeds
  */
  public function createProject($projectName, $ownerID){
    $result = new Result();
    $addProject = "INSERT INTO `project`(`projectName`, `ownerID`, `isPublished`) VALUES ('$projectName','$ownerID',0)";
    $query = mysqli_query($this->conn, $addProject);

    if (!$query){
      $result->setError("Error: mysqli_query error");
      return $result;
    }
    else{
      $result->setResult(true);
      return $result;
    }
  }
  /* removeProject(int)
  parameters: valid ownerID
  returns:
   - error if query fails
   - true if deletion succeeds
  */
  public function removeProject($projectID){
    $result = new Result();

    $deleteProject = "DELETE FROM project WHERE projectID = " . $projectID;
    $query = mysqli_query($this->conn, $deleteProject);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("Error: mysqli_query error");
      return $result;
    }
    else{
      $result->setResult(true);
      return $result;
    }
  }
  /* getAllPublishedProjects()
  parameters: n/a
  returns:
   - error if query fails
   - set of all published projects
  */
  public function getAllPublishedProjects(){
    $result = new Result();
    $findUser = "SELECT * FROM project WHERE isPublished = 1";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("Error: mysqli_query error");
      return $result;
    }
    else{
      $result->setResult($query);
      return $result;
    }
  }

  public function getAllProjects($username){

    $uID = $this->getUserID_Username($username);

    if ($uID->isError()){
      return $uID;
    }
    else{
      $result = new Result();
      $findUser = "SELECT * FROM project WHERE ownerID = ".$uID->getResult()."";
      $query = mysqli_query($this->conn, $findUser);

      if (!$query){ // If something went wrong with the query, return appropriate error
        // Error return: Unable to query DB
        $result->setError("Error: mysqli_query error");
        return $result;
      }
      else{
        $result->setResult($query);
        return $result;
      }
    }


  }
  // ******** SCENE FUNCTIONS ********

  /* checkSceneID(int):
  parameter: valid sceneID
  returns:
   - Error if the query fails
   - true bool if supplied an existing sceneID
   - false bool if supplied a sceneID that does not exist
  */
  public function checkSceneID($sceneID){
    $result = new Result();
    $findUser = "SELECT sceneID FROM scene WHERE sceneID = '$sceneID'";
    $query = mysqli_query($this->conn, $findUser);

    if (!$query){ // If something went wrong with the query, return appropriate error
      // Error return: Unable to query DB
      $result->setError("DatabaseAPI Error: mysqli_query error");
      return $result;
    }
    else{
      $rows = mysqli_num_rows($query); // Find number of rows retrieved
      // If the user exists, only ONE row should be returned, else user does not exist.
      if($rows == 1){
        $result->setResult(true);
        return $result;
      }
      else{
        $result->setResult(false);
        return $result;
      }
    }
  }
  /* removeScene(int)
  parameter: valid sceneID
  return:
   - error if query fails
   - true bool if successful
  */
  public function removeScene($sceneID){
    $result = new Result();
    $doesSceneExist = $this->checkSceneID($sceneID);
    if ((!$doesSceneExist->getError()) && (($doesSceneExist->getResult())==true)){
      $removeScene = "DELETE FROM sceneID WHERE sceneID = '$sceneID'";
      $query = mysqli_query($this->conn, $removeScene);

      if (!$query){
        $result->setError("DatabaseAPI Error: mysqli_query error");
        return $result;
      }
      else{
        $SQL = "DELETE FROM `options` WHERE sceneID LIKE $sceneID";
        $query = mysqli_query($this->conn, $removeScene);
        if (!$query){
          $result->setError("DatabaseAPI Error: mysqli_query error");
          return $result;
        }
        else {
          $result->setResult(true);
          return $result;
        }
      }
    }
    else if ((!$doesSceneExist->getError()) && (($doesSceneExist->getResult())==false)){
      $result->setError("DatabaseAPI Error: sceneID does not exist, and cannot be deleted from DB");
      return $result;
    }
    else{
      return $doesSceneExist;
    }
  }




}

?>
