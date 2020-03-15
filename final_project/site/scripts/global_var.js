

const myURL = "http://localhost/final_project/site";
const myapiURL = "http://localhost/final_project/api/scripts/";
//const myURL = "https://csfinal.erawsoft.com";
//const myapiURL = "https://erawsoft.com/";

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


