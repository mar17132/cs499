

function displayInterviewPage(loadURL)
{
    if(loadURL)
    {
        secondThread({
            'url':loadURL,
            'database':'refresh', 
            'page':'interviews'
            }
        );
    }
}

function displaySurvey(currentbutton)
{
    secondThread({
        url: myURL+'/documents/partial/interview_survey.php',
        database:{
            'studyid':currentbutton.siblings('.int-studyid').val(),
            'popid': currentbutton.siblings('.int-popid').val(),
            'groupid': currentbutton.siblings('.int-groupid').val(),
            'queid':  currentbutton.siblings('.int-quid').val()
        },
        'refresh_type':'refresh', 
        'page':'surveyquestions'
        }
    );
}

function displayInterviewRespons(currentbutton)
{
    secondThread({
        url:myURL+'/documents/partial/interview_respons_table.php',
        database:{
            'intid':currentbutton.siblings('.int-interviewid').val(),
            'studyid':currentbutton.siblings('.int-studyid').val(),
            'uid':currentbutton.siblings('.int-uid').val(),
            'popid':currentbutton.siblings('.int-popid').val(),
            'groupid': currentbutton.siblings('.int-groupid').val()           
        },
        'refresh_type':'refresh', 
        'page':'interviewsRespons'
        }
    );
}

function start_cancel_survey(queid,uid,status)
{
    secondThread({
        database:{
            'type':'interview',
            'return_results':'startcancelsurvey',
            'queid': queid,
            'uid': uid,
            'status':status         
        },
        'refresh_type':'refresh',         
        'page':'startcancelsurvey'
        }
    );
}

function end_survey()
{
    secondThread({
        database:{
            'type':'interview',
            'return_results':'endsurvey',
            'uid':$("#interviewer_uid").val(),
            'queid':$("#survey-queid").val(),
            'popid':$("#survey-popid").val(),
            'studyid':$("#survey-studyid").val(),
            'groupid':$("#survey-groupid").val(),
            'surveyinterview':$("#survey_interview_id").val(),
            'endtype':$("#surv-typeid").val()
        },
        'refresh_type':'refresh',         
        'page':'endsurvey'
        }
    );
}

function record_respons()
{
    let sendvar = [];

    $(".survey-anwsers:checked").each(function(){
        sendvar.push({
            'questionid': $(this).parents(".container")
            .children(".survey-question").val(),
            'anwserid':$(this).val(),
            'surveyinterview':$("#survey_interview_id").val(),
            'typeid':$(this).parents(".container")
            .children(".survey-quest-typeid").val()            
        });
    });

    secondThread({
        'database':{
            'type':'interview',
            'return_results':'recordrespons',
            'values':sendvar
        },
        'refresh_type':'refresh',         
        'page':'recordrespons'       
    });

    return sendvar;
}

function allquestionAnwsered()
{
    let returnval = true;

    $(".survey-question").each(function(){
        if($(this).nextAll().find(".survey-anwsers:checked").length == 0)
        {
            returnval = false;
            $(this).parent().addClass("error-no-anwser");
        }

    });

    return returnval;
}

function returnFromSurvey()
{
    $(".page-name").text("Interviews");
    $(".int-cmd-btn").removeClass("int-hidden-btns");
    $(".survey-cmd-btn").addClass("int-hidden-btns");
    $("#int-que-btn").trigger( "click" );
}

function restForm()
{
    $("#surv-typeid").val('null');
}

$(document).ready(function(){

    changeMenuAct("Interviews");

    $(".int-cmd-btn").on('click',function(){
        $(".int-cmd-btn").each(function(){
            $(this).removeClass("int-cmd-btn-active");
        });

        $(this).addClass("int-cmd-btn-active");

        buttonTxt = $.trim($(this).text());
        loadURL = null;

        if(buttonTxt == 'Que')
        {
            loadURL = myURL+"/documents/partial/interview_que_table.php";
        }
        else if(buttonTxt == 'Progress')
        {
            loadURL = myURL+"/documents/partial/interview_progress_table.php";
        }
        else if(buttonTxt == 'Completed')
        {
            loadURL = myURL+"/documents/partial/interview_completed_table.php";
        }

        displayInterviewPage(loadURL);

    });

    $(".interview-table-con").on('click','.int-show-anwsers-btn',function(){
        $(".int-respon-title").text($(this).parent().siblings(".int-popname").text());
        displayInterviewRespons($(this));
    });

    $(".interview-table-con").on('click','.int-start-survey-btn',function(){
        $(".page-name").text("Survey");
        $(".int-cmd-btn").addClass("int-hidden-btns");
        $(".survey-cmd-btn").removeClass("int-hidden-btns");
        displaySurvey($(this));
        start_cancel_survey($(this).siblings(".int-quid").val(),
        $("#interviewer_uid").val(),'1');
    });

    $("#yes-cancel-survey-btn").on('click',function(){        
        start_cancel_survey($("#survey-queid").val(),
        $("#interviewer_uid").val(),0);
        returnFromSurvey();
    });

    $("#end_survey_modal").on('hide.bs.modal',function(){
        restForm();
    });

    $("#errorMod").on('hide.bs.modal',function(){
        $(".errorMod-p").text("");
    });

    $(".interview-table-con").on('click','.survey-anwsers',function(){
        $(this).parents('.container').removeClass("error-no-anwser");
    });

    $("#surv-typeid").on('change',function(){
        $("#surv-typeid").removeClass("required");
        $(".form-error-msg").text("");
    });

    $("#survey-end-btn").on('click',function(){

        endtype = $("#surv-typeid").val();  

        if(endtype != 'null')
        {
            if(endtype == 3)
            {
                if(allquestionAnwsered())
                {
                    record_respons(); 
                    end_survey();                    
                    $("#end_survey_modal").modal("hide");
                    returnFromSurvey(); 
                }
                else
                {
                    $(".errorMod-p").text("Please fill out all questions.");
                    $("#end_survey_modal").modal("hide");
                    $("#errorMod").modal("show");
                }
            }
            else
            {
                end_survey();
                $("#end_survey_modal").modal("hide");
                returnFromSurvey();
            }

        }
        else
        {
            $("#surv-typeid").addClass("required");
            $(".form-error-msg").text("Please fill out Survey End Status.");
        }
    });

});

