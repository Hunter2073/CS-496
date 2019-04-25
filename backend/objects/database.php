<?php
class Database{

  // Database Credentials for this Obj
  private $servername = "";
  private $db_name = "";
  private $username = "";
  private $password = "";
  public $conn;

  // get the database connection
  public function getConnection(){

    $this->conn = mysqli_init( );

    //$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);

    $this->conn->options( MYSQLI_OPT_CONNECT_TIMEOUT, 3 );
    $this->conn->real_connect($this->servername, $this->username, $this->password, $this->db_name);

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    return $this->conn;
  }

  // Constructor: new Database()
  // Expected Param: integer 0 or 1
  // 0: local host testing // 1: prod server credentials
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
