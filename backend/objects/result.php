<?php
class Result{
    private $errorFlag=false;
    private $errorMessage="";
    private $happyResult="";

    public function __construct(){

    }

    public function setResult($input){
      $this->happyResult = $input;
    }

    public function getResult(){
      return $this->happyResult;
    }

    public function isError(){
      return $this->errorFlag;
    }

    public function setError($inputMsg){
      $this->errorFlag = true;
      $this->errorMessage = $inputMsg;
    }

    public function getError(){
      if ($this->isError()){
        return $this->errorMessage;
      }
    }
}
?>
