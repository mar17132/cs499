
let myURL;
let myapiURL;

function changeMenuAct(pageName)
{
    $(".site-menu-link").removeClass("active");
    $(".site-menu-link").each(function(){
        if($.trim($(this).text()) == pageName)
        {
            $(this).addClass("active");
        }
    });
}

$(document).ready(function(){

    myURL = "http://localhost/final_project/site";
    myapiURL = "http://localhost/final_project/api/scripts/";
    //myURL = "https://csfinal.erawsoft.com";
    //myapiURL = "https://erawsoft.com/";


});

