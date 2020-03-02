

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
        url:'http://localhost/final_project/site/documents/partial/interview_survey.php',
        database:{
            'studyid':currentbutton.siblings('.int-studyid').val()         
        },
        'refresh_type':'refresh', 
        'page':'surveyquestions'
        }
    );
}

function displayInterviewRespons(currentbutton)
{
    secondThread({
        url:'http://localhost/final_project/site/documents/partial/interview_respons_table.php',
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

function returnFromSurvey()
{
    $(".page-name").text("Interviews");
    $(".int-cmd-btn").removeClass("int-hidden-btns");
    $(".survey-cmd-btn").addClass("int-hidden-btns");
    $("#int-que-btn").trigger( "click" );
}

$(document).ready(function(){

    $(".int-cmd-btn").on('click',function(){
        $(".int-cmd-btn").each(function(){
            $(this).removeClass("int-cmd-btn-active");
        });

        $(this).addClass("int-cmd-btn-active");

        buttonTxt = $.trim($(this).text());
        loadURL = null;

        if(buttonTxt == 'Que')
        {
            loadURL = "http://localhost/final_project/site/documents/partial/interview_que_table.php";
        }
        else if(buttonTxt == 'Progress')
        {
            loadURL = "http://localhost/final_project/site/documents/partial/interview_progress_table.php";
        }
        else if(buttonTxt == 'Completed')
        {
            loadURL = "http://localhost/final_project/site/documents/partial/interview_completed_table.php";
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
    });

    $("#survey-back-btn").on('click',function(){
        returnFromSurvey();
    });

});

