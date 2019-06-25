<?php
// After sending there insult the user can go to this page that will show all current insults and the user can vote on there favorute.
// This page can only be accessed after a user has done an insult and this a session varaible will be made and a entry to the database.
function vote(){
    $authFile = fopen("auth.txt", "r");
    $Databaseusername = trim(fgets($authFile));
    $Databasepassword = trim(fgets($authFile));
    fclose($authFile);

    $insultid = $_POST['insultid'];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword); // open connection to database
        /* I haven't implmented score trackign in the Database yet. oops. $statment = $conn->query("INSERT INTO insult (userid, insult) VALUES (:user, :insult)"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->bindParam(':user', $_SESSION["userid"]);
        $statment->bindParam(':insult', $insullt);
        $statment->execute();
        echo json_encode($statment->fetch());*/
        $statment = $conn->query("UPDATE login SET voteRemaining = voteRemaining  - 1 WHERE username = $_SESSION['username'] AND voteRemaining > 0"; // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->execute();
    
    }catch(PDOException $e){
        echo json_encode("Error " + $e->getMessage());// The connection failed.
    };
};
function getRemaingVotes(){
    $authFile = fopen("auth.txt", "r");
    $Databaseusername = trim(fgets($authFile));
    $Databasepassword = trim(fgets($authFile));
    fclose($authFile);

    $statment = $conn->query("SELECT voteRemaining FROM login WHERE username = $_SESSION['username']"; // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
    $statment->execute();
    echo json_encode($statment->fetch());
};
if($_SERVER['request_method'] == 'POST'){
    vote();
}else{
    getRemaingVotes();
};
//JS fetch remaining vote's, and remove one each time a vote is caseted, do not send post if vote's are 0 and display error. when vote casted update database, 


?>