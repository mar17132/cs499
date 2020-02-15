
let fname;
let mname;
let lname;
let street;
let apt;
let city;
let state;
let zip;
let popid;
let phone;

function getPopFname(currentObject)
{
    return currentObject.parent().siblings(".popname").children(".fname").text();
}

function getPopMname(currentObject)
{
    return currentObject.parent().siblings(".popname").children(".mname").text();
}

function getPopLname(currentObject)
{
    return currentObject.parent().siblings(".popname").children(".lname").text();
}

function getPopid(currentObject)
{
    return currentObject.siblings("input[type=hidden]").val();
}

function getStreet(currentObject)
{
    return currentObject.parent().siblings(".popaddress").children(".street").text();   
}

function getCity(currentObject)
{
    return currentObject.parent().siblings(".popaddress").children(".city").text();
}

function getState(currentObject)
{
    return currentObject.parent().siblings(".popaddress").children(".state").text();
}

function getZip(currentObject)
{
    return currentObject.parent().siblings(".popaddress").children(".zip").text();
}

function getPhone(currentObject)
{
    return currentObject.parent().siblings(".popphone").text();
}

function displayEditPop(currentObject)
{
    fname.val(getPopFname(currentObject));
    mname.val(getPopMname(currentObject));
    lname.val(getPopLname(currentObject));
    street.val(getStreet(currentObject));
    city.val(getCity(currentObject));
    state.val(getState(currentObject));
    zip.val(getZip(currentObject));
    phone.val(getPhone(currentObject));
    popid.val(getPopid(currentObject));
}

function clear_editAdd_input()
{
    $(".form-input").each(function(){
        $(this).val("");
    });

}

function changeTitle(newTitle)
{
    $(".addedit_pop_title").text(newTitle);
}

function getChangeTitle()
{
    return $(".addedit_pop_title").text();
}

function addPop()
{
    secondThread({
        database:{
            'type':'population',
            'return_results':'add',
            'fname':fname.val(),
            'mname':mname.val(),
            'lname':lname.val(),
            'street':street.val(),
            'apt':apt.val(),
            'city':city.val(),
            'state':state.val(),
            'zip':zip.val(),
            'phone':phone.val()         
        },
        'page':'population'
        },refreshContentPop
    );
}

function updatePop()
{
    secondThread({
        database:{
            'type':'population',
            'return_results':'update',
            'id':popid.val(), 
            'fname':fname.val(),
            'mname':mname.val(),
            'lname':lname.val(),
            'street':street.val(),
            'apt':apt.val(),
            'city':city.val(),
            'state':state.val(),
            'zip':zip.val(),
            'phone':phone.val()                    
        },
        'page':'population'
        },refreshContentPop
    );
}

function updatePopGroups()
{
    let sendArray = [];

    $(".group-chkbox").each(function(){
        sendArray.push({
            'popid':$(this).siblings(".hidden-pop-id").val(),
            'groupid':$(this).siblings(".hidden-pop-group-id").val(),
            'member': $(this).is(":checked") ? '1' : '0'
        });
    });

    secondThread({
        database:{
            'type':'population',
            'return_results':'popgroupupdate',
            'values':sendArray                 
        },
        'page':'population'
        }
    );
}

function displayGroupPop(populationid)
{
    secondThread({
        url:'http://localhost/final_project/site/documents/partial/population_group_table.php',
        database:{
            'id':populationid              
        },
        'refresh_type':'groups', 
        'page':'population'
        }
    );
}

function displayAllGroupPop()
{
    secondThread({
        url:'http://localhost/final_project/site/documents/partial/population_all_groups_table.php',
        'database':'refresh', 
        'page':'groups'
        }
    );
}

function refreshContentPop()
{
    secondThread({
        'url':'http://localhost/final_project/site/documents/partial/population_table.php',
        'database':'refresh',
        'page':'population'
    });
}

function checkPopInputs()
{
    if($(".required").length == 0)
    {
        return true;
    }

    return false;
}

$(document).ready(function(){

    fname = $("#fname");
    mname = $("#mname");
    lname = $("#lname");
    street = $("#street");
    apt = $("#apt");
    city = $("#city");
    state = $("#state");
    zip = $("#zip");
    phone = $("#phone");
    popid = $("#popid");

    $(".pop-table").on('click','.pop-edit-btn',function(){
        //user will have close modal with close button
        $("#pop_Add_Edit").modal({
            backdrop:"static",
            keyboard:false
        });

        changeTitle("Edit Population");
        clear_editAdd_input();
        displayEditPop($(this));

    }); 

    $('.form-input').on('blur',function(){

        if(($(this).attr('id') != mname.attr('id')) && 
          ($(this).attr('id') != apt.attr('id')))
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

    $("#add-pop-btn").on('click',function(){

        //user will have close modal with close button
        $("#pop_Add_Edit").modal({
            backdrop:"static",
            keyboard:false
        });

        changeTitle("Add Population");
        clear_editAdd_input();
    });

    $("#popAddEdit_btn").on('click',function(){

        if(getChangeTitle() == 'Edit Population')
        {
            if(checkPopInputs())
            {
                updatePop();
                $("#pop_Add_Edit").modal("hide");
                clear_editAdd_input();
                return;
            }
        }
        else
        {
            if(checkPopInputs())
            {
                addPop();
                $("#pop_Add_Edit").modal("hide");
                clear_editAdd_input();
                return;
            }
        }

        $(".form-error-msg").text(
            "Error: Please make sure all feilds have input");

    });

    $("#delete_pop_btn").on('click',function(){

        secondThread({
                database:{
                    'type':'population',
                    'return_results':'delete',
                    'id':$("#delete_popid").val()                
                },
                'page':'population'
            },refreshContentPop
        );
    
    });

    $(".pop-table").on('click',".pop-delete-btn",function(){    
        $("#delespan_pop_name").text(getPopFname($(this)) + " " + getPopLname($(this)));
        $("#delete_popid").val(getPopid($(this)));
    });

    $(".pop-table").on('click','.pop-groups-btn',function(){
        displayGroupPop(getPopid($(this)));
        $(".pop-groups-title").text(getPopFname($(this)) + " " + getPopLname($(this)));
    });

    $("#save_pop_groups_btn").on('click',function(){
        updatePopGroups();
    });
    
    $("#view-Groups-btn").on('click',function(){
        displayAllGroupPop();
        $("#allGroups").modal({
            backdrop:"static",
            keyboard:false
        });
    });

});

