<?php
//This file is used for testing perposes only!!!
// Use this file to test code without interfering with the rest of the code.
session_start();

$authFile = fopen("auth.txt", "r") or die("unable to open file"); //I wanna find a way to save this information wthout having to read from a file all the time, I know $_SESSION is written to a file so seem's a little silly to move it from one file to another. Might make preformace a little better. 
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);
//Reading from file workes
try {

$conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword);//Currently not connection due to missing driver.
echo json_encode("it works");
}
catch(PDOException $e)
{   
    echo json_encode("connection failed: " . $e->getMessage());
}

//echo json_encode($_SESSION["username"]);

?>