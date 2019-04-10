<?php
include dirname(__DIR__, 1)."/objects/database.php";
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

  public function createUser($uName, $pWord){
    $hash = password_hash($pWord, PASSWORD_DEFAULT);

    $addUser = "INSERT INTO user(uName, pWord) VALUES ('$uName', '$hash')";

    $query = mysqli_query($this->conn, $addUser);

    if (!$query){
      return false;
    }
    else{
      return true;
    }
  }
}

  ?>
