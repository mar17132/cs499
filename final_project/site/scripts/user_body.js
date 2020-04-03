
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

function refreshContent()
{
    secondThread({
        'url':myURL+'/documents/partial/user_table.php',
        'database':'refresh',
        'page':'users'
    });
}

function displayUserPermis(uid)
{
    secondThread({
        'url':myURL+'/documents/partial/user_permissions_table.php',
        'database':{'userid':uid},
        'page':'users',
        'refresh_type':'permissions'        
    });
}

function updateUserPermis()
{
    let sendVar = [];

    $(".userpermission-select").each(function(){
        sendVar.push({
            'userid': $(this).siblings(".hidden-permis-uid").val(),
            'study_id':$(this).siblings(".hidden-studyid").val(),
            'permissions':$(this).val()
        });
    });

    secondThread({
        'database':{
            'type':'user',
            'return_results':'permissionsUpdate',
            'values':sendVar
        },
        'page':'users'       
    });
}

function displayEditUser(editbtnclk)
{
    let utype = getUtypeVal(editbtnclk);
    $("#edit_uid").val(getHiddenVal(editbtnclk));
    $("#uname").val(getUnameVal(editbtnclk));
    $("#type_id option").each(function(){
        if($(this).text() == utype)
        {
            $(this).parent().val($(this).val());
        }
    });
}

function clearUserInputs()
{
    $("#edit_uid").val("");
    $("#uname").val("");
    $("#passwd").val("");
    $("#type_id").val('null');
    $(".form-error-msg").text("");
    $(".form-input").each(function(){
        $(this).removeClass('required');
    });
}

function editUser()
{
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
        },refreshContent
    );
}

function addUser()
{
    secondThread({
        'database':{
            'type':'user',
            'return_results':'add',
            'uname':$("#uname").val(),
            'type_id': $("#type_id").val(),  
            'passwd': $("#passwd").val()          
        },
        'page':'users'
        },refreshContent
    );
}

function checkInput()
{
    returnCheck = true;

    $(".form-input").each(function(){

        if($(this).val() == null || $(this).val().trim() == "" 
           || $(this).val() == "null")
        {
            returnCheck = false;
            $(this).addClass("required");
        }
    });
    
    return returnCheck;
}

$(".user-table").on('click',".editbtn",function(){
    clearUserInputs();
    $(".addedit_title").text("Edit User");
    displayEditUser($(this));
    //user will have close modal with close button
    $("#userAddEdit").modal({
        backdrop:"static",
        keyboard:false
    });
});

$(".user-table").on('click',".deletebtn",function(){    
    let uname = getUnameVal($(this));
    $("#delespan_uname").text(uname);
    $("#delete_uname").val(uname);
    $("#delete_uid").val(getHiddenVal($(this)));
});

$("#userAddEdit_btn").on('click',function(){
      
    if($(".addedit_title").text() == 'Edit User')
    {
        if($("#uname").val() != null && $.trim($("#uname").val()) != "")
        {
            editUser();
            $("#userAddEdit").modal('hide'); 
        }
        else
        {
            $(".form-error-msg").text(
                "Error: Please make sure the username has input"
                );
            return;
        }
    }
    else
    {
        if(checkInput())
        {
            addUser();
            $("#userAddEdit").modal('hide'); 
        }
        else
        {
            $(".form-error-msg").text(
                "Error: Please make sure that all fields have input"
                );
            return;
        }
    }

});

$("#add-user-btn").on('click',function(){
    clearUserInputs();
    $(".addedit_title").text("Add User");
    $("#userAddEdit").modal('show');
    //user will have close modal with close button
    $("#userAddEdit").modal({
        backdrop:"static",
        keyboard:false
    });    
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
        },refreshContent
    );

});

$("#userAddEdit_close_btn").on('click',function(){
    clearUserInputs();
});

$('#uname').on('focus',function(){

});

$("#userAddEdit").on('shown.bs.modal',function(){
    $("#uname").trigger('focus');
});

$('.form-input').on('blur',function(){

    if($(".addedit_title").text() == "Add User" || ($(this).attr('id') == $("#uname").attr('id')))
    {
        if($(this).val() == null || $(this).val().trim() == "" 
        || $(this).val() == "null")
        {
            $(this).addClass("required");
        }
    }
});

$('.form-input').on('change',function(){    
    $(this).removeClass("required");        
});

$('.form-input').on('click',function(){
    $(this).removeClass("required");   
});

$(".user-table").on('click','.permissionbtn',function(){
    $(".username-permiss-title").text(getUnameVal($(this)));
    displayUserPermis(getHiddenVal($(this)));
});

$("#save_userpermission_btn").on('click',function(){
    updateUserPermis($(this));
});


$(document).ready(function(){
    changeMenuAct("Users");
});

