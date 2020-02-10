
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
        
    });
    

});

