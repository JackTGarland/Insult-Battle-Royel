function postInsult(){
    var xhr2 = new XMLHttpRequest();
    var insult = document.getElementById("insult").innerText;
    var toSend = "insult="+insult;
    if(insult != null){ //I can use == but as an extra caution I will set to <.
        //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                var parent = document.getElementById("insult").parentNode;
                parent.removeChild("insult");// Removes the textbox of insult,
                var textnode = document.createTextNode(insult);
                var attribute = document.createAttribute("id"); // Replaces the textbox with just plain text of the insult.
                attribute.value = "afterInsult";
                textnode.setAttributeNode(attribute);
                parent.appendChild(textnode);
            }else{
                alertError(xhr2.status);
            };
        };
        xhr2.open("POST", "/PHP/Match.php");
        xhr2.send(toSend);
    }else{
        alert("Please enter an insult in the text box first.");
    }
};
function getMatch(){
    var xhr2 = new XMLHttpRequest();
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            if (JSON.parse(xhr2.response) != "NFA"){
            document.getElementById("partner").innerHTML = (JSON.parse(xhr2.response));
            }else{
                document.getElementById("partner").innerText = "No partner's are avalible. Sorry :(";
            };
        };
    };
    xhr2.open("GET", "/PHP/Match.php");
    xhr2.send();
};
function alertError(err){
    alert("There was an error status code :" + err);
};
function goVote(){
    window.location.href = "./php/vote.php";
};