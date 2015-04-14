/**
 * Created by Fredrik on 10.04.2015.
 */
function nav(obj, id){
    var url = document.URL;
    var opacityValue = '0.3';
    if(url.indexOf("#fag-"+ id) > -1){
        opacityValue = '1';
        window.location.href = "#";
    }
    else{
        window.location.href = '#fag-'+id;
    }

    var subjects =  document.getElementsByClassName("subjectimg");
    for(var i = 0; i < subjects.length; i++){
        subjects[i].style.opacity = opacityValue;
        subjects[i].nextSibling.style.backgroundColor = "#5C9632";
        subjects[i].parentNode.className = "subject subjectNormal";
    }
    obj.firstChild.style.opacity = "1";
    obj.children[1].style.backgroundColor = "#00BFD5";
}

function subjectPosition(){
    var url = document.URL;
    url = url.split("/");
    if(url.length < 7){
        var subjects =  document.getElementsByClassName("subject");
        for(var i = 0; i < subjects.length; i++){
            subjects[i].className = 'subject';
        }
    }

}
subjectPosition();