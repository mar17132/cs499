

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

$(".user-table").on('click',".editbtn",function(){
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

$(".user-table").on('click',".deletebtn",function(){    
    let uname = getUnameVal($(this));
    $("#delespan_uname").text(uname);
    $("#delete_uname").val(uname);
    $("#delete_uid").val(getHiddenVal($(this)));
});

$("#update_user_btn").on('click',function(){
   
    secondThread({
            database:{
                'type':'user',
                'return_results':'update',
                'uname':$("#uname").val(),
                'uid':$("#edit_uid").val(),
                'type_id': $("#type_id").val(),  
                'passwd': $("#passwd").val()          
            },
            'page':'users'
        }
    );

    refreshContent();
});

$("#delete_user_btn").on('click',function(){

    secondThread({
            database:{
                'type':'user',
                'return_results':'delete',
                'uname':$("#delete_uname").val(),
                'uid':$("#delete_uid").val()                
            },
            'page':'users'
        }
    );

    refreshContent();
});


function refreshContent()
{
    secondThread({
        'url':'http://localhost/final_project/site/scripts/user_table.php',
        'database':'refresh',
        'page':'users'
    });
}





