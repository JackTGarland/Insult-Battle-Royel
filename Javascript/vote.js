function getVotesRemaining() {
    
    var xhr2 = new XMLHttpRequest();
    //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById("voteremain").innerHTML = (JSON.parse(xhr2.response));
            //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
        }else{
            alertError(xhr2.status);
        };
    }
    xhr2.open("GET", "/PHP/Vote.php");
    xhr2.send();
    //document.getElementById('results').innerHTML = e.target.responceText;
};
function postVote(){
    var xhr2 = new XMLHttpRequest();
    var votesleft = document.getElementById("voteremain").value;
    if(votesLeft <= 0){ //I can use == but as an extra caution I will set to <.
        //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
            
                document.getElementById("voteremain").value = votesleft - 1; // we are changing the value of the HTML so that it show's the current vote's left, but only if we get a sucessful response from the server.
            }else{
                alertError(xhr2.status);
            };
        }
        xhr2.open("POST", "/PHP/Vote.php");
        xhr2.send();
    }else{
        //make vote red and shake maybe, display alert box?
    }
};
function alertError(err){
    alert("There was an error status code :" + err);
};
function getInsults(){
    /*generate insults in there own div with button.
    Send get request and get vote's remaining, then send second get request for insults.
    Ajax header's maybe?
    
    */
};
function vote() {
    var e = window.event,
        btn = e.target || e.srcElement;
    
};