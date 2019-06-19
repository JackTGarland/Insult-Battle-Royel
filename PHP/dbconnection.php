<?php
//This file is used for testing perposes only!!!
session_start();

$authFile = fopen("auth.txt", "r") or die("unable to open file");
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);
//Reading from file workes
try {

$conn = new PDO("mysql:host=localhost;dbname=assign140;", $Databaseusername, $Databasepassword);//Currently not connection due to missing driver.
echo json_encode("it works");
}
catch(PDOException $e)
{   
    echo json_encode("connection failed: " . $e->getMessage());
}

//echo json_encode($_SESSION["username"]);

?>