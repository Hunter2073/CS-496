<?php
//error_reporting(E_ERROR | E_PARSE); // Removes unwanted warnings
include 'databaseapi.php';

class BackendAPI{
  public $databaseapi;

  // Constructor: new DatabaseAPI()
  // Expected Param: integer 0 or 1
  // 0: local host testing // 1: prod server credentials
  public function __construct($input){
    $this->databaseapi = new DatabaseAPI($input);
  }

/* login(string, string)
parameters: valid username, valid password
returns:
 - Error if invalid Input
 - Error if getUserPassword() returns one
 - true/false bool if password is correct/incorrect
*/
  public function login($uName, $pWord){
    $result = new Result();
    if ($uName == null || $pWord == null){
      $result->setError("Error: Invalid Input");
    }
    else { //Valid information from caller
      // Query to retrieve user information
      $dbPW = $this->databaseapi->getUserPassword($uName);

      if ($dbPW->isError()){
        return $dbPW;
      }
      else{
        if (is_bool($dbPW->getResult())){
          $result->setResult(false);
        }
        else {
          $result->setResult(password_verify($pWord, $dbPW->getResult()));
        }
      }
    }
    return $result;
  }

/* newAccount(string, string)
parameters: valid username, valid password
returns:
 - Error if invalid input
 - Error if checkUsername returns one
 - Error if username already exists
 - True bool if account creation succeeds
 - Error if createUser returns one
*/
  public function newAccount($uName, $pWord){
    $result = new Result();
    if ($uName == null || $pWord == null){
      $result->setError("Error: Invalid Input");
      return $result;
    }
    else { //Valid information from caller

      // Authenticate username + pword against requirements

      // Query to retrieve user information
      $exists = $this->databaseapi->checkUsername($uName);

      // If the user exists, only ONE row should be returned, else user does not exist.
      if ($exists->isError()){
        return $exists;
      }
      else if($exists->getResult()==true){
        $result->setError("BackendAPI Error: User already exists");
        return $result;
      }
      else{
        // User does not already exist. Therefore can be created.
        $insert = $this->databaseapi->createUser($uName, $pWord);

        if (!$insert->isError()){
          $result->setResult(true);
          return $result;
        }
        else {
          return $insert;
        }
      }
    }
  }

  public function newProject($uName, $pName, $pMsg){
    $result = new Result();
    // Use $uName to get uID
    $uID = $this->databaseapi->getUserID_Username($uName);

    if (!$uID->isError()){
      // Use uID to create new Project
      $res = $this->databaseapi->createProject($pName, $uID->getResult());
      if (!$res->isError()){
        $result->setResult(true);
        return $result;
      }
      else{
        return $res;
      }
    }
    else {
      return $uID;
    }
  }

}

?>
