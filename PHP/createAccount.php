<?php
session_start();

$authFile = fopen("auth.txt", "r"); // Hide the username and password from being uploaded to git. ;)
$databaseUsername = trim(fgets($authFile));
$databasePassword = trim(fgets($authFile));
fclose($authFile);

$username = $_GET["username"];
$password = $_GET["password"]; // Get's password from the ajax request.
$fName = $_GET["name"];

try {
    if($username or $password or $fName != null){
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword);//Connect's to the database.
        $statment = $conn->prepare("SELECT username FROM login WHERE username=:user"); // Run's the statment. NOTE: currently vunrable to SQL injection.
        $statment->bindParam(":user", $username);
        $statment->execute();
            $row=$statment->fetchAll(); // Stores all rows in $row.
            if($row != null){
                echo json_encode("That username is already taken"); // If anything is returned then the username is taken.
            }else{
                $results = $conn->query("INSERT INTO users (username, password, firstname) 
                VALUES ('$username',$password','$fName'");
                echo json_encode($results); // For debug only do not return results to user.
            }
        };
        catch(PDOException $e)
        {   
            echo json_encode("connection failed: " . $e->getMessage()); // Returns the error is any ocoured. 
        };
    };
?>