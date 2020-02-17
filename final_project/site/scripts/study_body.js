
let sname;
let studyType;
let orderQuest;
let tryamount;
let startdate;
let enddate;
let studyid_edit;
let save_add_edit_study_btn;
let print_form_error;
let add_study_btn;
let dele_study_btn;


function getStudyId(currentObj)
{
    return currentObj.siblings("input[type=hidden]").val();
}

function getStudyName(currentObj)
{
    return currentObj.parent().siblings(".studyname").text();
}

function getOrderQuestion(currentObj)
{
    orderQ = currentObj.parent().siblings(".studyorder").text();
    returnVar = 'null';

    $("#orderQuest option").each(function(){
        if($(this).text() == orderQ)
        {
            returnVar = $(this).val();
        }
    });

    return returnVar;
}

function getTry(currentObj)
{
    return currentObj.parent().siblings(".studytrys").text();
}

function getStartDate(currentObj)
{
    return currentObj.parent().siblings(".startdate").text();
}

function getEndDate(currentObj)
{
    return currentObj.parent().siblings(".enddate").text();
}

function getStudyType(currentObj)
{
    returnVar = 'null';
    stype = currentObj.parent().siblings(".studytype").text();

    $("#studyType option").each(function(){
        if($(this).text() == stype)
        { 
            returnVar = $(this).val();
        }
    });

    return returnVar;
}

function addStudy()
{
    secondThread({
        database:{
            'type':'study',
            'return_results':'add',
            'name':sname.val(),
            'type_id':studyType.val(),
            'try_amount':tryamount.val(),
            'start_date':startdate.val(),
            'end_date':enddate.val(),
            'order_questions':orderQuest.val()       
        },
        'page':'study'
        },refreshContentStudy
    );
}

function editStudy()
{
    secondThread({
        database:{
            'type':'study',
            'return_results':'update',
            'id':studyid_edit.val(),
            'name':sname.val(),
            'type_id':studyType.val(),
            'try_amount':tryamount.val(),
            'start_date':startdate.val(),
            'end_date':enddate.val(),
            'order_questions':orderQuest.val()       
        },
        'page':'study'
        },refreshContentStudy
    );
}

function deleteStudy()
{
    secondThread({
        database:{
            'type':'study',
            'return_results':'delete',
            'id':$("#delete_studyid").val()    
        },
        'page':'study'
        },refreshContentStudy
    );
}

function refreshContentStudy()
{
    secondThread({
        'url':'http://localhost/final_project/site/documents/partial/study_table.php',
        'database':'refresh',
        'page':'study'
    });
}

function compareDate()
{
    returnVar = false;

    try
    {
        startArray = startdate.val().split("-");
        endArray = enddate.val().split("-");
        datestart = new Date(startArray[0],startArray[1],startArray[2]);
        dateend = new Date(endArray[0],endArray[1],endArray[2]);

        if(datestart < dateend)
        {
            returnVar = true;
        }
    }
    catch
    {
        returnVar = false;
    }

    return returnVar;
}

function checkDate(inputText)
{
    returnVar = false;

    try
    {
        inputArray = inputText.split("-");
        year = parseInt(inputArray[0]);
        month = parseInt(inputArray[1]);
        day = parseInt(inputArray[2]);
        currentdate = new Date();
        currentyear = parseInt(currentdate.getFullYear());

        if(year >= currentyear)
        {
            if(month > 0 && month < 13)
            {
                switch(month)
                {
                    case 1:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 2:
                        returnVar = (day > 0 && day <= 
                            ((year % 4 == 0) ? 29 : 28)) ? true : false;
                    break;
                    case 3:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 4:
                        returnVar = (day > 0 && day <= 30) ? true : false;
                    break;
                    case 5:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 6:
                        returnVar = (day > 0 && day <= 30) ? true : false;
                    break;
                    case 7:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 8:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 9:
                        returnVar = (day > 0 && day <= 30) ? true : false;
                    break;
                    case 10:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    case 11:
                        returnVar = (day > 0 && day <= 30) ? true : false;
                    break;
                    case 12:
                        returnVar = (day > 0 && day <= 31) ? true : false;
                    break;
                    default:
                        returnVar = false;
                }
            }
            else
            {
                returnVar = false;
            }
        }
        else
        {
            returnVar = false;
        }

    }
    catch
    {
        returnVar = false;
    }

    return returnVar;
}

function displayStudyEdit(currentObj)
{
    sname.val(getStudyName(currentObj));
    studyType.val(getStudyType(currentObj));
    orderQuest.val(getOrderQuestion(currentObj));
    tryamount.val(getTry(currentObj));
    startdate.val(getStartDate(currentObj));
    enddate.val(getEndDate(currentObj));
    studyid_edit.val(getStudyId(currentObj));
}

function clearStudyInputs()
{
    $(".required").removeClass("required");
    sname.val("");
    studyType.val('null');
    orderQuest.val('null');
    tryamount.val("");
    startdate.val("");
    enddate.val("");
    studyid_edit.val("");
    print_form_error.text("");
}

function checkStudyInputs()
{
    returnVar = true;

    if($(".required").length > 0)
    {
        returnVar = false;
    }
    else
    {
        $(".form-input").each(function(){
            if($(this).val() == "null" || $(this).val() == null ||
            $(this).val().trim() == "")
            {
                returnVar = false;
                $(this).addClass("required");
            }
        });
    }

    return returnVar;
}

$(document).ready(function(){    

    sname = $("#sname");
    studyType = $("#studyType");
    orderQuest = $("#orderQuest");
    tryamount = $("#tryamount");
    startdate = $("#startdate");
    enddate = $("#enddate");
    studyid_edit = $("#studyid-edit");
    save_add_edit_study_btn = $("#studysaveAddEdit_btn");
    print_form_error = $(".form-error-msg");
    add_study_btn = $("#add-study-btn");
    dele_study_btn = $("#dele_study_btn");

    $(".study-table").on('click','.study-pop-btn',function(){

        $(".studyname-groups").text(getStudyName($(this)));
        secondThread({
            'url':'http://localhost/final_project/site/documents/partial/study_groups_table.php',
            database:{
                'id':getStudyId($(this))               
            },
            'type':'study',
            'refresh_type':'refresh',
            'page':'studygroup'
            }
        );
    });

    $(".study-table").on('click','.study-edit-btn',function(){
        clearStudyInputs();
        $(".study_modal_title").text("Edit Study");
        $("#study_Add_Edit").modal({
            backdrop:"static",
            keyboard:false
        });
        displayStudyEdit($(this));
    });

    $(".study-table").on('click','.study-delete-btn',function(){
        clearStudyInputs();
        $("#delespan_study_name").text(getStudyName($(this)));
        $("#delete_studyid").val(getStudyId($(this)));
    });

    add_study_btn.on('click',function(){
        clearStudyInputs();
        $(".study_modal_title").text("Add Study");
        $("#study_Add_Edit").modal({
            backdrop:"static",
            keyboard:false
        });
    });

    $('.form-input').on('blur',function(){

        if($(this).val() == null || $(this).val().trim() == "" 
        || $(this).val() == "null")
        {
            $(this).addClass("required");
        }        
        
    });
    
    $('.form-input').on('change',function(){    
        $(this).removeClass("required");        
    });
    
    $('.form-input').on('click',function(){
        $(this).removeClass("required");   
    });

    save_add_edit_study_btn.on('click',function(){
        if($(".study_modal_title").text() == "Add Study")
        {
            if(checkStudyInputs())
            {
                addStudy();
                $("#study_Add_Edit").modal("hide");
                clearStudyInputs();
            }
            else
            {
                print_form_error.text("Error: Please make sure all feilds have input.");
            }
        }
        else
        {
            //edit study
            if(checkStudyInputs())
            {
                editStudy();
                $("#study_Add_Edit").modal("hide");
                clearStudyInputs();
            }
            else
            {
                print_form_error.text("Error: Please make sure all feilds have input.");
            }
        }

    });

    startdate.on('blur',function(){
        if($(this).val() != null || $(this).val().trim() != "")
        {
            if(!checkDate($(this).val()))
            {
                $(this).addClass("required");
            }
        }
    });

    enddate.on('blur',function(){
        if($(this).val() != null || $(this).val().trim() != "")
        {
            if(!checkDate($(this).val()))
            {
                $(this).addClass("required");
            }

            if(!compareDate())
            {
                $(this).addClass("required");
            }
        }
    });
    
    dele_study_btn.on('click',function(){
        deleteStudy();
    });

});

