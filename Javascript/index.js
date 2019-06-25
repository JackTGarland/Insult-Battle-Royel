function ajexrequest() {
    var xhr2 = new XMLHttpRequest();

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var creditals = "username="+username+"&password="+password
    //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById('failed').innerHTML = (JSON.parse(xhr2.response));
            //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
        };
    }
    xhr2.open("POST", '/PHP/login.php');
    xhr2.send(creditals);
    //document.getElementById('results').innerHTML = e.target.responceText;
};
/*function responceRecived(e){
    console.log(JSON.stringify(e.response));
    document.getElementById('results').innerHTML = e.target.responceText;
};*/
function logout() {
    var xhr2 = new XMLHttpRequest();
    
    xhr2.open("GET", '/PHP/logout.php');
    xhr2.send();

};
function filetest(){
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById('failed').innerHTML = (JSON.parse(xhr2.response));
            //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
        };
    }
    xhr2.open("GET", '/PHP/dbconnection.php');
    xhr2.send();
};
function createAccount(){

    var xhr2 = new XMLHttpRequest();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var fName = document.getElementById("fName").value;
    if(username != null && password != null && fName != null){
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                //reload page
            }
        }
        xhr2.open("POST", '/PHP/createAccount.php?username=' + username + '&password=' + password + '&name=' + fName);
        xhr2.send();
    }
    else{
        
    }
};
function endorse() {
    var e = window.event,
        btn = e.target || e.srcElement;
    
};
function search(){
    var xhr2 = new XMLHttpRequest();
    var search = document.getElementById('search').value;
    document.getElementById('results').innerHTML = "";
    if(search != null){
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                if(JSON.parse(xhr2.response)==="NRF"){
                    document.getElementById('results').innerHTML = "No Results Found";
                }else{
                for(var i = 0; i < JSON.parse(xhr2.response).length; i++){
                    var row = document.createElement("div");
                    var br = document.createElement("br");
                    var span = document.createElement("span");
                    br.setAttribute("id", "br"+i);
                    for(var key in JSON.parse(xhr2.response)[i]){
                        if(JSON.parse(xhr2.response)[i].hasOwnProperty(key)){
                            if(isNaN(key)==false){
                                console.log(key);
                            }else{
                        var rowelements = document.createElement("div");
                        rowelements.setAttribute("id", "rowelement"+key);
                        span.setAttribute("id", "span"+i);
                        span.innerHTML = '<button id="button'+i+'" onclick="endorse()" value="endorse"> endorse </button>';
                        row.appendChild(rowelements);
                        rowelements.innerHTML =JSON.parse(xhr2.response)[i][key];
                            };
                        };
                        
                    }
                    row.appendChild(span);
                    row.appendChild(br);
                    document.getElementById("results").appendChild(row);
                };
            };
        }
        }
        xhr2.open("GET", '/PHP/search.php?search=' + search);
        xhr2.send();
    }else{
        document.getElementById()
    }

};