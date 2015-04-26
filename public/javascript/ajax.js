
    function ajaxCall(method, url, async, elementToUpdate){
        var xmlhttp = new XMLHttpRequest();
        if (!(typeof(elementToUpdate)==='undefined')){
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById(elementToUpdate).innerHTML = xmlhttp.responseText;
                }
                else if(xmlhttp.readyState==4 && xmlhttp.status==401){
                    window.location = '/';
                }
            };
            //loading animation
            document.getElementById(elementToUpdate).innerHTML = "<img width='20' height='20' src='http://www.adobe.com/business/calculator/VIP/image/loader.gif'>"
        }
        xmlhttp.open(method, url, async);
        xmlhttp.send();
    }