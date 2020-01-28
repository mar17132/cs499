

function getHiddenVal(currentObj)
{
    return currentObj.siblings("input[type=hidden]").val();
}

function getUnameVal(currentObj)
{
    return currentObj.parent().siblings(".uname").text();
}

function getUtypeVal(currentObj)
{
    return currentObj.parent().siblings(".utype").text();
}

$(".editbtn").on('click',function(){
    let utype = getUtypeVal($(this));
    $("#edit_uid").val(getHiddenVal($(this)));
    $("#uname").val(getUnameVal($(this)));
    $("#type_id option").each(function(){
        if($(this).text() == utype)
        {
            $(this).attr('selected','selected');
        }
    });
});

$(".deletebtn").on('click',function(){    
    let uname = getUnameVal($(this));
    $("#delespan_uname").text(uname);
    $("#delete_uname").val(uname);
    $("#elete_uid").val(getHiddenVal($(this)));
});



$("#delete_user_btn").on('click',function(){
    $.post("http://localhost/final_project/api/scripts/api.call.php",
        {
            'type':'user',
            'return_results':'delete',
            'uname':$("#delete_uname").val(),
            'uid':$("#delete_uid").val()
        },
        function(data,status,xhr){
            if(status == "success")
            {
                console.log(data);
            }
            else
            {
                console.log(status);
            }
    },"text");
});


