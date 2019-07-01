<?php
// After sending there insult the user can go to this page that will show all current insults and the user can vote on there favorute.
// This page can only be accessed after a user has done an insult and this a session varaible will be made and a entry to the database.
session_start();
function vote(){
    $authFile = fopen("auth.txt", "r");
    $databaseUsername = trim(fgets($authFile));
    $databasePassword = trim(fgets($authFile));
    fclose($authFile);

    $insultid = $_POST["insultid"];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword); // open connection to database
        /* I haven't implmented score trackign in the Database yet. oops. $statment = $conn->query("INSERT INTO insult (userid, insult) VALUES (:user, :insult)"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->bindParam(':user', $_SESSION["userid"]);
        $statment->bindParam(':insult', $insullt);
        $statment->execute();
        echo json_encode($statment->fetch());*/
        $statment = $conn->prepare("UPDATE login SET voteRemaining = voteRemaining  - 1 WHERE username = :user AND voteRemaining > 0"); // Run's query on database. Will not work if there are no vote's remaing. If returns error, send to user, if returns 0 row's, return to user. (This will need testing.)
        $statment->bindParam(":user", $_SESSION["username"]);
        $statment->execute();
    
    }catch(PDOException $e){
        echo json_encode("Error " + $e->getMessage());// The connection failed.
    };
};
function getRemaingVotes(){
    $authFile = fopen("auth.txt", "r");
    $databaseUsername = trim(fgets($authFile));
    $databasePassword = trim(fgets($authFile));
    fclose($authFile);
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword);
        $statment = $conn->prepare("SELECT voteRemaining FROM login WHERE username = :user"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->bindParam(':user' , $_SESSION["username"]);
        $statment->execute();
        echo json_encode($statment->fetch());
    }catch(PDOException $e){
        echo json_encode("Error " + $e->getMessage());// The connection failed.
    };
};
function getInsults(){
    $authFile = fopen("auth.txt", "r");
    $databaseUsername = trim(fgets($authFile));
    $databasePassword = trim(fgets($authFile));
    fclose($authFile);
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword);
        $statment = $conn->prepare("SELECT insult FROM insult"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->execute();
        echo json_encode($statment->fetchAll());
    }catch(PDOException $e){
        echo json_encode("Error " + $e->getMessage());// The connection failed.
    };
};
if($_SERVER['request_method'] == 'POST'){
    vote();
}else{
    getRemaingVotes();
    getInsults(); // Can't do it this way. maybe call it if vote's remaining has been called before. with $_SESSION["votesLeft"]??
};
//JS fetch remaining vote's, and remove one each time a vote is caseted, do not send post if vote's are 0 and display error. when vote casted update database, 


?>