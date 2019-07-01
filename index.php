<?php
session_start();
include '../php/login.php';
include '../php/logout.php';
include '../php/dbconnection.php';
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
</html>

