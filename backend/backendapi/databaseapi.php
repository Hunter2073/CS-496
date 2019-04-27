<?php
include dirname(__DIR__, 1)."/objects/database.php";
//include dirname(__DIR__, 1).'/objects/error.php';
include dirname(__DIR__, 1).'/objects/result.php';


class DatabaseAPI{
  private $conn;

  public function __construct($input){
    $database = new Database($input);
    $this->conn = $database->getConnection();
  }

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


  public function createProject($projectName, $ownerID){
    $result = new Result();
    $addProject = "INSERT INTO project(projectName, ownerID) VALUES ('$projectName', '$ownerID')";

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

  public function removeProject($projectID){
    $result = new Result();
    if ($this->checkUsername($uName)){
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
    else {
      $result->setResult(false);
      return $result;
    }
  }

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
    
  public function getImg(){
      $result = new Result();
      $image = mysqli_query($this->conn, "SELECT imgDir FROM scene WHERE projectID=1 AND sceneID=1");
      $result->setResult($image);
      return $result;
  }
    
  public function getTxt(){
      $result = new Result();
      $txt = mysqli_query($this->conn, "SELECT description FROM scene WHERE projectID=1 AND sceneID=1");
      $result->setResult($txt);
      return $result;
  }
    
  public function getOptions(){
      $result = new Result();
      $opts = mysqli_query($this->conn, "SELECT oText FROM options WHERE sceneID=1");
      $result->setResult($opts);
      return $result;
  }
}
?>
