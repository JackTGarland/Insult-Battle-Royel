function ajexrequest() {
    var xhr2 = new XMLHttpRequest();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var creditals = "username="+username+"&password="+password
    //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById("success").innerHTML = (JSON.parse(xhr2.response));
            window.location.href = "./php/match.php";
        }else{
            alertError(xhr2.status);
        }
    }
    xhr2.open("POST", "/PHP/login.php");
    xhr2.send(creditals);
    //document.getElementById('results').innerHTML = e.target.responceText;
};
/*function responceRecived(e){
    console.log(JSON.stringify(e.response));
    document.getElementById('results').innerHTML = e.target.responceText;
};*/
function logout() {
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            location.reload();
        }else{
            alertError(xhr2.status);
        };
    };
    
    xhr2.open("GET", "/PHP/logout.php");
    xhr2.send();

};
function filetest(){ // used as a simple debug, make a button call this function and it will execute the debug code written in dbconnection.php
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById("failed").innerHTML = (JSON.parse(xhr2.response));
            //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
        };
    }
    xhr2.open("GET", "/PHP/dbconnection.php");
    xhr2.send();
};
function createAccount(){

    var xhr2 = new XMLHttpRequest();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var fName = document.getElementById("fName").value;
    var creditals = "username="+username+"&password="+password+"&firstname="+fName;
    if(username != null && password != null && fName != null){
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                //reload page
            }
        }
        xhr2.open("POST", "/PHP/createAccount.php?username=" + username + "&password=" + password + "&name=" + fName);
        xhr2.send(creditals);
    }
    else{
        
        alertError(xhr2.status);
    }
};
/*
function endorse() {
    var e = window.event,
        btn = e.target || e.srcElement;
    
};
This is legacy code from a old project but I will need this for the vote section to find what vote button was pressed, as such I am leaving it here for when I need to imploment that section. */

function alertError(err){
    alert("There was an error status code :" + err);
};