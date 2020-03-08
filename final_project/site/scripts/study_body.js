
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
//let dele_study_question_btn;
let questionAddEdit_btn;
//let study_quest_edit_btn;
let add_question_btn;
let connect_group_study_btn;
let connect_group_save_btn;

//question
let quest_studid;
let quest_typeid;
let quest_question;
let quest_order;
let quest_add_anwser_btn;
let quest_anwser_order_sele;

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
        },refreshAllAdd
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
        },refreshAllAdd
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
        },refreshAllAdd
    );
}

function refreshContentStudy()
{
    secondThread({
        'url':myURL+'/documents/partial/study_table.php',
        'database':'refresh',
        'page':'study'
    });
}

function refreshQuesitonStudy(currentObj)
{
    secondThread({
        'url':myURL+'/documents/partial/study_questions_table.php',
        'database':{'id':getStudyId(currentObj)},
        'page':'studyquesiton',
        'refresh_type':'refresh'
    });
}

function refreshQuestionEdit()
{
    secondThread({
        'url':myURL+'/documents/partial/question_add_edit_table.php',
        'database':'refresh',
        'page':'questionEdit',
        'refresh_type':'refresh'
    });
}

function refreshStudy_connect()
{
    secondThread({
        'url':myURL+'/documents/partial/study_connect_group_table.php',
        'database':'refresh',
        'page':'studyGroupConnect',
        'refresh_type':'refresh'
    });
}


function refreshAllAdd()
{
    refreshContentStudy();
    refreshStudy_connect();
    refreshQuestionEdit();
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

function displayAddQuestion()
{
    quest_add_anwser_btn.attr('disabled','disabled');
}

function dispalyEditQuestion(obj)
{
    quest_studid.val(obj[0].studyid);
    quest_typeid.val(obj[0].qtype);
    quest_question.val(obj[0].question);
    quest_order.val(obj[0].qorder); 
    quest_anwser_order_sele.val(obj[0].isanwsers_order);
    $("#quest_edit_id").val(obj[0].questionid);

    questionType = obj[0].qtype;
    tbody = $(".answer_addedit_tbody");

    //print table headers
    if(questionType == '9' || questionType == '11')
    {
        tbody.before(createChk_Mul_head());
    }

    //loop the array
    $.each(obj,function(key,row){
        if(questionType == '9' || questionType == '11')
        {
            createChk_Mul_Ans().appendTo(tbody);
            $(".answsers_txt_input").last().val(row.anwser);
            $(".anwser_order_txt").last().val(row.aorder);
            $(".anwserid_question_edit").last().val(row.anwserid);
        }
    });

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

    //add question
    enableElem(quest_add_anwser_btn);
    quest_studid.val("null");
    quest_typeid.val('null');
    enableElem(quest_typeid);
    enableElem(quest_studid);
    quest_question.val('');
    quest_order.val(""); 
    $(".answer_addedit_tbody").empty();
    $(".answer_addedit_table thead").remove();
    quest_anwser_order_sele.val('0');

    //connect group
    $("#connectgroupid").val('null');
    $("#connectStudyid").val('null');
    
}

function checkStudyInputs(form)
{
    returnVar = true;

    if($(".required").length > 0)
    {
        returnVar = false;
        $(this).addClass("required");
    }
    else
    {
        form.each(function(){
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

function createfill_in_blank()
{
    Ansinputs = "<tr><td><div class='form-group' ><input placeholder='Placholder' "; 
    Ansinputs += "class='form-control question-addedit-form addedit-answer ";
    Ansinputs += "answsers_txt_input' type='text' /></div></td>";
    Ansinputs += "<td><input type='hidden' class='anwserid_question_edit ' />";
    Ansinputs += "<button type='button' class='btn btn-danger remove_answer_btn'>";   
    Ansinputs += "Remove </button></td></tr>";

    return $(Ansinputs);
}

function createfill_in_head()
{
    Ansinputs = "<thead><tr><th scope='col'>Placeholder</th>";
    Ansinputs += "<th scope='col'>Action</th></tr></thead>";

    return $(Ansinputs);
}

function createChk_Mul_Ans()
{
    Ansinputs = "<tr><td><div class='form-group' ><input placeholder='Answer' "; 
    Ansinputs += "class='form-control form-input question-addedit-form addedit-answer";
    Ansinputs += " answsers_txt_input' type='text' /></div></td>";
    Ansinputs += "<td><div class='form-group' ><input type='text' "; 
    Ansinputs += "class='form-control question-addedit-form addedit-answer ";
    Ansinputs += "form-input anwser_order_txt' placeholder='Question Order' ";
    Ansinputs += "/></div></td>";
    Ansinputs += "<td><input type='hidden' class='anwserid_question_edit ' />";
    Ansinputs += "<button type='button' class='btn btn-danger remove_answer_btn'>";   
    Ansinputs += "Remove </button></td></tr>";

    return $(Ansinputs);
}

function createChk_Mul_head()
{
    Ansinputs = "<thead><tr><th scope='col'>Answer</th>";
    Ansinputs += "<th scope='col'>Order</th>";
    Ansinputs += "<th scope='col'>Action</th></tr></thead>";

    return $(Ansinputs);
}

function disableElem(obj)
{
    obj.attr('disabled','disabled');
}

function enableElem(obj)
{
    obj.removeAttr('disabled');
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
   // dele_study_question_btn = $(".study-quest-del-btn");
    questionAddEdit_btn = $("#questionAddEdit_btn");
   // study_quest_edit_btn = $(".study-quest-edit-btn");
    add_question_btn = $("#add-question-btn");
    connect_group_study_btn = $("#connect_group_study_btn");
    connect_group_save_btn = $("#connect_group_save_btn");

    //question
    quest_studid = $("#studyid");
    quest_typeid = $("#qtype");
    quest_question = $("#question");
    quest_order = $("#qorder");
    quest_add_anwser_btn = $("#quest_anwser_add_btn");
    quest_anwser_order_sele = $("#questaorder");

    $(".study-table").on('click','.study-pop-btn',function(){

        $(".studyname-groups").text(getStudyName($(this)));
        secondThread({
            'url':myURL+'/documents/partial/study_groups_table.php',
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

    $(".study-table").on('click','.study-questions-btn',function(){
        //opent the view questions modal        
        clearStudyInputs();
        $(".studyname-groups").text(getStudyName($(this)));
        refreshQuesitonStudy($(this));
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

    $('.answer_addedit_tbody').on('blur','.form-input',function(){

        if($(this).val() == null || $(this).val().trim() == "" 
        || $(this).val() == "null")
        {
            $(this).addClass("required");
        }        
        
    });
    
    $('.answer_addedit_tbody').on('change','.form-input',function(){    
        $(this).removeClass("required");        
    });
    
    $('.answer_addedit_tbody').on('click','.form-input',function(){
        $(this).removeClass("required");   
    });

    $('.connect-group-contain').on('blur','.form-input',function(){

        if($(this).val() == null || $(this).val().trim() == "" 
        || $(this).val() == "null")
        {
            $(this).addClass("required");
        }        
        
    });
    
    $('.connect-group-contain').on('change','.form-input',function(){    
        $(this).removeClass("required");        
    });
    
    $('.connect-group-contain').on('click','.form-input',function(){
        $(this).removeClass("required");   
    });

    $('.question-add-edit-contain').on('blur','.form-input',function(){

        if($(this).val() == null || $(this).val().trim() == "" 
        || $(this).val() == "null")
        {
            $(this).addClass("required");
        }        
        
    });
    
    $('.question-add-edit-contain').on('change','.form-input',function(){    
        $(this).removeClass("required");        
    });
    
    $('.question-add-edit-contain').on('click','.form-input',function(){
        $(this).removeClass("required");   
    });

    save_add_edit_study_btn.on('click',function(){
        if($(".study_modal_title").text() == "Add Study")
        {
            if(checkStudyInputs($(".study-addedit-form")))
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
            if(checkStudyInputs($(".study-addedit-form")))
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

    $(".study-quesiton-contain").on('click','.study-quest-del-btn',function(){
        //delete the question from the databases and the study
        secondThread({
            database:{
                'type':'study',
                'return_results':'deletequestion',
                'questionid':$(this).siblings(".questionid-study").val()
            },
            'page':'study'
            }
        );
      $("#study_questions_modal").modal("hide");

    });

    $(".study-quesiton-contain").on('click','.study-quest-edit-btn',function(){
        //to open the Edit question modal
        $("#question_add_edit_modal").modal({
            backdrop:"static",
            keyboard:false
        });
        clearStudyInputs();
        disableElem(quest_typeid);
        disableElem(quest_studid);
        $(".quetion-add-edit-title").text("Edit");

        secondThread({
            database:{
                'type':'study',
                'return_results':'getquestion',
                'studyid':$(this).siblings(".question-studyid").val(),
                'questionid': $(this).siblings(".questionid-study").val()  
            },
            'page':'questionEditrefresh',
            'refresh_type':'refresh'
            }
        );

    });

    add_question_btn.on('click',function(){
        //to open the add question modal
        clearStudyInputs();
        $(".quetion-add-edit-title").text("Add");
        displayAddQuestion();
        $("#question_add_edit_modal").modal({
            backdrop:"static",
            keyboard:false
        });
    });

    quest_add_anwser_btn.on('click',function(){
        
        if(quest_typeid.val() != 'null')
        {
            tbody = $(".answer_addedit_tbody");
            disableElem(quest_typeid);

            switch(quest_typeid.val())
            {
                case '10':
                    tbody.before(createfill_in_head());
                    createfill_in_blank().appendTo(tbody);
                    disableElem($(this));
                break;
                case '11':
                    if($('.answer_addedit_tbody tr').length == 0)
                    {
                        tbody.before(createChk_Mul_head());
                    } 
                    createChk_Mul_Ans().appendTo(tbody);
                break;
                case '9':
                    if($('.answer_addedit_tbody tr').length == 0)
                    {
                        tbody.before(createChk_Mul_head());
                    }
                    createChk_Mul_Ans().appendTo(tbody);
                break;
                default:
            }
        }

    });

    quest_typeid.on("change",function(){
        if($(this).val() != 'null')
        {
            enableElem(quest_add_anwser_btn);
        }
        else
        {
            disableElem(quest_add_anwser_btn);
        }
    });

    $('.answer_addedit_tbody').on('click','.remove_answer_btn',function(){
        //this will remove the answer when adding and delete when editing
        //questions

        if($(".quetion-add-edit-title").text() == "Edit")
        {
            answerid = $(this).siblings(".anwserid_question_edit").val();
            if(answerid != null && answerid != "")
            {
                secondThread({
                    database:{
                        'type':'study',
                        'return_results':'removeanwser',
                        'answerid':answerid,  
                        'questiontype':$("#qtype").val()
                    },
                    'page':'study',
                    'refresh_type':'nothing'
                    }
                );
            }
            
        }

        $(this).parent().parent().remove();

        if($('.answer_addedit_tbody tr').length == 0)
        {
            $(".answer_addedit_table thead").remove();
            enableElem(quest_typeid);
            enableElem(quest_add_anwser_btn);
        }

    });

    $("#connect_group_modal").on('hidden.bs.modal',function(){
        clearStudyInputs();
    });

    $(".study-group-table").on('click',".study-removegroup-btn",function(){
       
        $("#study_groups_modal").modal('hide');

        secondThread({
            database:{
                'type':'study',
                'return_results':'removegroup',
                'groupid':$(this).siblings(".study-groupid-modal").val(),  
                'studyid':$(this).siblings(".studyid-group-modal").val()
            },
            'page':'study'
            }
        );
        
    });
    
    connect_group_save_btn.on('click',function(){
        secondThread({
            database:{
                'type':'study',
                'return_results':'addgroup',
                'groupid':$("#connectgroupid").val(),  
                'studyid':$("#connectStudyid").val()
            },
            'page':'study'
            }
        );
    });

    questionAddEdit_btn.on('click',function(){
        //to save the question
        if(checkStudyInputs($(".question-addedit-form")) && 
        $(".addedit-answer").length > 0)
        {
            if($(".quetion-add-edit-title").text() == 'Add')
            {
                answersArray = [];

                $(".answsers_txt_input").each(function(){
                    if($("#qtype").val() == '9' || $("#qtype").val() == '11')
                    {
                        answersArray.push({
                            'answer':$(this).val(),
                            'order':$(this).parent().parent().next().children().
                            children().val()
                        });
                    }
                    else if($("#qtype").val() == '10')
                    {
                        answersArray.push({'answer':$(this).val()});
                    }
                });

                secondThread({
                    database:{
                        'type':'study',
                        'return_results':'addquestion',
                        'typeid':$("#qtype").val(),  
                        'studyid':$("#studyid").val(),
                        'qaorder':$("#questaorder").val(),
                        'question':$("#question").val(),
                        'qorder':$("#qorder").val(),
                        'values':answersArray    
                    },
                    'page':'study'
                    }
                );

                $("#question_add_edit_modal").modal("hide");
                $("#study_questions_modal").modal("hide");
            }
            else
            {
                //edit a question
              
                answersArray = [];

                $(".answsers_txt_input").each(function(){
                    
                    if($("#qtype").val() == '9' || $("#qtype").val() == '11')
                    {
                       
                        orderInput = $(this).parent().parent().next().children().
                            children();
                         id = orderInput.parent().parent().next().
                            children(".anwserid_question_edit").val();   

                        answersArray.push({
                            'answer':$(this).val(),
                            'order':orderInput.val(),
                            'id':(id != "") ? id : 'null'
                        });
                    }
                    else if($("#qtype").val() == '10')
                    {
                        id = $(this).parent().parent().next().
                        children(".anwserid_question_edit").val();

                        answersArray.push({
                            'answer':$(this).val(),
                            'id':(id != "") ? id : 'null'
                        });
                    }
                });
                
                secondThread({
                    database:{
                        'type':'study',
                        'return_results':'updatequestion',
                        'questionid':$("#quest_edit_id").val(),
                        'typeid':$("#qtype").val(),  
                        'studyid':$("#studyid").val(),
                        'qaorder':$("#questaorder").val(),
                        'question':$("#question").val(),
                        'qorder':$("#qorder").val(),
                        'values':answersArray   
                    },
                    'page':'study'
                    }
                );
            }
            $("#question_add_edit_modal").modal("hide");
            $("#study_questions_modal").modal("hide");
        }
        else
        {
            print_form_error.text("Error: Please have all fields filled out");
        }
    });

});

