<?php
class ErrorThrow{
  public $message = "";

  public function __construct($input){
    $this->message = $input;
  }

  public function getErrorMsg(){
    return $this->message;
  }
}
?>
