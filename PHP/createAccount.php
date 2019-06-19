<?php
session_start();

$authFile = fopen("auth.txt", "r"); // Hide the username and password from being uploaded to git. ;)
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);

$username = $_GET['username'];
$password = $_GET['password']; // Get's password from the ajax request.
$fName = $_GET['name'];

try {

    $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword);//Connect's to the database.
    $results = $conn->query("SELECT username FROM login WHERE username='$username'"); // Run's the statment. NOTE: currently vunrable to SQL injection.
        $row=$results->fetchAll(); // Stores all rows in $row.
        if($row != null){
            echo json_encode("That username is already taken"); // If anything is returned then the username is taken.
        }else{
            $results = $conn->query("INSERT INTO users (username, password, firstname) 
            VALUES ('$username',$password','$fName'");
            echo json_encode($results); // For debug only do not return results to user.
        }
    }
    catch(PDOException $e)
    {   
        echo json_encode("connection failed: " . $e->getMessage()); // Returns the error is any ocoured. 
    }
?>