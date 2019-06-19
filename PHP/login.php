<?PHP
session_start();

$authFile = fopen("auth.txt", "r");
$Databaseusername = trim(fgets($authFile));
$Databasepassword = trim(fgets($authFile));
fclose($authFile);


/*
$results = $conn>query("SELECT * FROM student WHERE course='$a'");
while($row=$results->fetch())
{
    echo "<P>";
    echo " student ID ". $row["ID"] . "<br/>";
    echo " name " . $row["name"] . "<br/>";
    echo "phone " . $row["phone"] . "<br/>" ;
    echo "</P>";
}*/
    $username = $_GET['username'];
    $password = $_GET['password'];
	//if($username == "admin" & $password == "admin"){
    //Due to no access to database this is used to simulate database query.
    try {
        $conn = new PDO("mysql:host=localhost;dbname=insultBR;", $Databaseusername, $Databasepassword);
        $results = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
        $row = $results->fetch();
        if ($row != null) {
            $_SESSION["name"] = $row["name"];
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
		    createSession();
		    echo json_encode($row);
        }else{
		    echo json_encode("Failure");
        };
    }catch(PDOException $e){

            //$_SESSION["username"] = $username;
            //$_SESSION["password"] = $password;
            //$_SESSION["admin"]=1;
            //$_SESSION["failed"]=1; //this is used for testing, disable code that will try to use the database.
		    //createSession();
            echo json_encode("connection failed defaulting to admin");
            //as PHP myadmin is having trouble but for testing purpose we make it work.
    };

function createSession(){
   
     $_SESSION["token"] = (($_SESSION["username"].strlen + $_SESSION["password"].strlen) + 100 / 25) * 100;
     //A really bad token system but it works for this so I am keeping it for now.
}


?>