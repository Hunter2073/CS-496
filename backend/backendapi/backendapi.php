<?php
//error_reporting(E_ERROR | E_PARSE); // Removes unwanted warnings
include 'databaseapi.php';
include dirname(__DIR__, 1).'/objects/error.php';

class BackendAPI{
  private $databaseapi;

  // Constructor: new DatabaseAPI()
  // Expected Param: integer 0 or 1
  // 0: local host testing // 1: prod server credentials
  public function __construct($input){
    $this->databaseapi = new DatabaseAPI($input);
  }

  public function login($uName, $pWord){
    if ($uName == null || $pWord == null){
      $error = new ErrorThrow("Error: Invalid Input");
      return $error;
    }
    else { //Valid information from caller
      // Query to retrieve user information
      $dbPW = $this->databaseapi->getUserPassword($uName);

      // Check for errors HERE
      if (is_string($dbPW)){
        if (password_verify($pWord, $dbPW)){
          return true;
        }
        else {
          // Error return: incorrect password
          $error = new ErrorThrow("Error: Incorrect Password");
          return $error;
        }
      }
      if (strcmp(get_class($dbPW), "ErrorThrow")==0){
        return $dbPW;
      }
    }
  }

  public function newAccount($uName, $pWord){

    if ($uName == null || $pWord == null){
      return new ErrorThrow("Error: Invalid Input");
    }
    else { //Valid information from caller

      // Authenticate username + pword against requirements

      // Query to retrieve user information
      $exists = $this->databaseapi->checkUsername($uName);

      // If the user exists, only ONE row should be returned, else user does not exist.
      if($exists){
        // User already exists
        // Failure message is sent back w/ appropriate info
        return new ErrorThrow("Error: User already exists");
      }
      else{
        // User does not already exist. Therefore can be created.
        $insert = $this->databaseapi->createUser($uName, $pWord);

        if ($insert){
          return true;
        }
        else {
          return new ErrorThrow("Error: mysqli_query error");
        }
      }
    }
  }
}

?>
