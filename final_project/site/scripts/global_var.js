
let myURL;
let myapiURL;


$(document).ready(function(){

    myURL = "http://localhost/final_project/site";
    myapiURL = "http://localhost/final_project/api/scripts/";
    //myURL = "https://csfinal.erawsoft.com";
    //myapiURL = "https://erawsoft.com/";


    $(".site-menu-link").on('click',function(){
        $(".site-menu-link").removeClass("active");
        $(this).addClass("active");
    });

});

