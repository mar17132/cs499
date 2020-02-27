

$(document).ready(function(){

    $(".int-cmd-btn").on('click',function(){
        $(".int-cmd-btn").each(function(){
            $(this).removeClass("int-cmd-btn-active");
        });
        $(this).addClass("int-cmd-btn-active");
    });

});

