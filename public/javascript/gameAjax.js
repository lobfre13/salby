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
        xmlhttp.open("GET","/main/showGame/"+str, true);
        xmlhttp.send();
        window.location.href = "#";
    }
}

function addFavourite(obj, str){
    if (str == "") return;
    else {
        xmlhttp = new XMLHttpRequest();
        result = null;
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                result = xmlhttp.responseText;

                if(result === '1') obj.style.backgroundImage = "url('/public/img/favorittericon2.png')";
                else obj.style.backgroundImage = "url('/public/img/favorittericon1.png')";
            }
        }
        xmlhttp.open("GET","/main/updateFavourite/?id="+str+"&url="+document.URL, true);
        xmlhttp.send();
    }
}


function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
}
