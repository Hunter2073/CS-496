<?php
class Database{

  // specify your own database credentials
  private $servername = "";
  private $db_name = "";
  private $username = "";
  private $password = "";
  public $conn;

  // get the database connection
  public function getConnection(){

    $this->conn = null;

    $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);

    return $this->conn;
  }

  public function __construct($input){
    if ($input == 0){ // Localhost DB
      $this->servername = "localhost";
      $this->username = "root";
      $this->password = "";
      $this->db_name = "gameenginedb";
    }
    else { // Prod DB
      $this->servername = "people.wku.edu";
      $this->username = "kth81383";
      $this->password = "nk4k9n8wR_yQTjjU";
      $this->db_name = "gameenginedb";
    }
  }
}
?>
