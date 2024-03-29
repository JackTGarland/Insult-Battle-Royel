<?php
// This will be used to match two player's. 
// Find a player with the avaible flag in the database, set to false and add user to match.
// Then display awaiting insult page, set new session varible that states they are in a match so we don't have to ping the database each time.
session_start();
function matchCheck(){
    if ($_SESSION["matched"] == null){
        $authFile = fopen("auth.txt", "r");
        $databaseUsername = trim(fgets($authFile));
        $databasePassword = trim(fgets($authFile));
        fclose($authFile);

        try {
            $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword); // open connection to database
            $results = $conn->query("SELECT userID,firstname FROM login WHERE fightAvalible=1"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
            $row = $results->fetchAll(); // return all rows from the reults of the query, There should only be one row as usernames are uniqe. 
            if (sizeof($row) == 1) {
                echo json_encode("NFA"); // Returns No FIght's avalible.
            }else{
                $diffrent = 0;
                while($diffrent == 0){//This while loop is to pick a random oponut from a list, and ensure that is not the same user.
                    $match = rand(1,sizeof($row));
                    if($row["userid"] != $_SESSION["username"]){
                        $diffrent = 1;
                    }
                };
                $_SESSION["matched"] = $row["firstname"];
                $statment = $conn->prepare("INSERT INTO fight (player1, player2) VALUES (:user1, :user2);
                INSERT INTO login (fightAvalible) VALUES (0) WHERE username = :user1;
                INSERT INTO login (fightAvalible) VALUES (0) WHERE userid = :user2");
                $statment->bindParam(":user1", $_SESSION["username"]);
                $statment->bindParam(":user2", $row["userid"]);
                $statment->execute();
                echo json_encode($statment->fetch()); // Debug purposes. remove in final release NOTE: I'm not 100% sure that ->fetch is the correct statment. Will test this when front end connected.
            };
        }catch(PDOException $e){
            echo json_encode("Error " + $e->getMessage());// The connection failed.
        };
    }else{
        echo json_encode($_SESSION["matched"]); // If match already found, will return the match's first name.
    };
};

function saveInsult(){
    $authFile = fopen("auth.txt", "r");
    $databaseUsername = trim(fgets($authFile));
    $databasePassword = trim(fgets($authFile));
    fclose($authFile);

    $insult = $_POST["insult"];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $databaseUsername, $databasePassword); // open connection to database
        $statment = $conn->query("INSERT INTO insult (userid, insult) VALUES (:user, :insult);
        INSERT INTO login (hasInsulted) VALUES (1)"); // Run's query on database. NOTE: unsure but on current understannding this is not sql injection vunruable in current state.
        $statment->bindParam(":user", $_SESSION["userid"]);
        $statment->bindParam(":insult", $insullt);
        $statment->execute();
        echo json_encode($statment->fetch());

    
    }catch(PDOException $e){
        echo json_encode("Error " + $e->getMessage());// The connection failed.
    };
};
if($_SERVER["request_method"] == "POST"){
    saveInsult();
}else{
    matchCheck();
};
//front end code
// Timedisplay in Javascript. Time remaining is StartDate + 24 hour's + 24 for each bracket. 
?>