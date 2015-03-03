function loadGame(str) {
    if (str == "") {
        document.getElementById("game").innerHTML = "";
        return;
    }
    else {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("game").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","/main/ajax/"+str, true);
        xmlhttp.send();
        window.location.href = "#";
    }
}

function addFavourite(str){
    if (str == "") return;
    else {

        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST","/main/game/"+str, true);
        xmlhttp.send();
    }
}


function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
}
