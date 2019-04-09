<?php
include_once 'objects/database.php';

$database = new Database(0); //localhost
//$database = new Database(1); //Prod DB
$conn = $database->getConnection();

echo "Successful connection!"; //replace with api stuff






?>