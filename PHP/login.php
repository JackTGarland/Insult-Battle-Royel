<?PHP
session_start();

$authFile = fopen("auth.txt", "r");
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);

    $username = $_POST['username'];// get username from ajax. 
    $password = $_POST['password'];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword); // open connection to database
        $statment = $conn->prepare("SELECT * FROM login WHERE username=:user AND password=:pass"); // Run's query on database. NOTE: sql injection vunruable in current state.
        $statment->bindParam(':user', $username);
        $statment->bindParam(':pass', $password);
        $row = $statment->fetch(); // return first row from the reults of the query, There should only be one row as usernames are uniqe. 
        if ($row != null) {
            $_SESSION["name"] = $row["name"];
            $_SESSION["userid"] = $row["userid"];
            $_SESSION["username"] = $username; // all usernames must be uniqe, so no more then one row should be found.
            $_SESSION["password"] = $password; // Maybe a bad idea to store the password in a session. maybe make null after use in create session.
		    echo json_encode($row); // Debug purposes. remove in final release
        }else{
		    echo json_encode("Failure");
        };
    }catch(PDOException $e){
            echo json_encode("connection failed" + $e);// The connection failed.
    };

?>