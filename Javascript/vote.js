function getVotesRemaining() {
    
    var xhr2 = new XMLHttpRequest();
    //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
    xhr2.onreadystatechange = function(){
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            document.getElementById('voteremain').innerHTML = (JSON.parse(xhr2.response));
            //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
        };
    }
    xhr2.open("GET", '/PHP/Vote.php');
    xhr2.send();
    //document.getElementById('results').innerHTML = e.target.responceText;
};
function postVote(){
    var xhr2 = new XMLHttpRequest();
    var votesleft = document.getElementById('voteremain').innerHTML;
    var voted = document.getElementById('option').innerHTML
    if(voted != 0){
        //xhr2.addEventListner("load", responceRecived(xhr2));//crashes on this line
        xhr2.onreadystatechange = function(){
            if (xhr2.readyState == 4 && xhr2.status == 200) {
            
                document.getElementById('voteremain').innerHTML = voted - 1;
                //document.getElementById('results').innerHTML = (JSON.stringify(xhr2.response));
            };
        }
        xhr2.open("POST", '/PHP/Vote.php');
        xhr2.send();
    }else{
        //make vote red and shake maybe, display alert box?
    }
};
