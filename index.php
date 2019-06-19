<?php
session_start();
include '../PHP/login.php';
include '../PHP/logout.php';
include '../PHP/dbconnection.php';
?>
<html>
<head>
<title>Insult BR</title>
<link rel="stylesheet" type="text/css" href="CSS/main.css">
<script>
function statusf() {
    var xdata = <?php echo json_encode($_SESSION["name"]); ?>;
    if (xdata == null) {
        document.getElementById("status").innerHTML = "You are not logged in.";
    } else {
        document.getElementById('status').innerHTML = "Welcome back "+xdata;
    };
};
</script>
</head>
<body onload="statusf()">
<div id="loginstatus">
<p id="status"></p>
</div>
<div id="login">
<input id="username" placeholder="username" /><br/>
<input id="password"  placeholder="password" /><br/>
<input id="fName" placeholder="First name" /><br/>
<input type="button" value="login" onclick="ajexrequest()" />
<input type="button" value="logout" onclick="logout()" />
<input type="button" value="Create Account" onclick="createaccount()" />
<p id="failed"></p>

</body>
<?php
/*function login(){
    $username = $_GET["username"];
    $password = $_GET["password"];

    if ($results != null) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
		//createSession();
		echo json_encode('succsess');
    }else{
		echo json_encode('Failed');
    };
}*/
/*function createSession(){
   
     $_SESSION["token"] = (($_SESSION["username"].strlen + $_SESSION["password"].strlen) + 100 / 25) * 100;
}*/
?>
</html>

