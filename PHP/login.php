<?PHP
session_start();

$authFile = fopen("auth.txt", "r");
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);

    $username = $_GET['username'];// get username from ajax. 
    $password = $_GET['password'];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword); // open connection to database
        $results = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'"); // Run's query on database. NOTE: sql injection vunruable in current state.
        $row = $results->fetch(); // return first row from the reults of the query, There should only be one row as usernames are uniqe. 
        if ($row != null) {
            $_SESSION["name"] = $row["name"];
            $_SESSION["username"] = $username; // all usernames must be uniqe, so no more then one row should be found.
            $_SESSION["password"] = $password; // Maybe a bad idea to store the password in a session. maybe make null after use in create session.
		    createSession();
		    echo json_encode($row); // Debug purposes. remove in final release
        }else{
		    echo json_encode("Failure");
        };
    }catch(PDOException $e){
            echo json_encode("connection failed" + $e);// The connection failed.
    };

function createSession(){
   
     $_SESSION["token"] = (($_SESSION["username"].strlen + $_SESSION["password"].strlen) + 100 / 25) * 100;
     //A really bad token system but it works for this so I am keeping it for now.
}


?>