var fadeInTime = 300;
var fadeOutTime = 300;


$(document).ready(function() {
    $("body").css("display", "none");

    $("body").fadeIn(fadeInTime);

    $("a").click(function(event){
        if($(this).attr("href").indexOf("#") < 0){
            event.preventDefault();
            linkLocation = this.href;
            $("body").fadeOut(fadeOutTime, redirectPage);
        }
    });

    $("#loginSubmit").click(function(event) {
        event.preventDefault();
        $("body").fadeOut(fadeOutTime, submitForm);
    });

    function submitForm(){
        $("#login").submit();
    }

    function redirectPage() {
        window.location = linkLocation;
    }
});

