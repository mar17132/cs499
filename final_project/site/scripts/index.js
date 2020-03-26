
function display_question_stat(studyid,questionid)
{
    secondThread({
        url: myURL+'/documents/partial/question_stats_table.php',
        database:{
            'studyid':studyid,
            'questionid': questionid
        },
        'refresh_type':'refresh', 
        'page':'questionstat'
        }
    );
}

function display_question_select(studyid)
{
    secondThread({
        url: myURL+'/documents/partial/dashboard_question_select.php',
        database:{
            'studyid':studyid
        },
        'refresh_type':'refresh', 
        'page':'questionselect'
        }
    );
}

function display_system_count()
{
    secondThread({
        'url':myURL+'/documents/partial/system_count_table.php',
        'database':'refresh', 
        'page':'systemcount',
        'refresh_type':'refresh'
        }
    );
}

function display_study_count()
{
    secondThread({
        'url':myURL+'/documents/partial/study_stats_table.php',
        'database':'refresh', 
        'page':'studystats',
        'refresh_type':'refresh'
        }
    );
}

$(document).ready(function(){
    changeMenuAct("Home");

    //display_system_count();
    //display_study_count();

    $('#studyid').on('change',function(){
        if($(this).val() != 'null')
        {
            display_question_select($(this).val());
            $("#questionid").removeAttr('disabled');
        }
        else
        {
            $("#questionid").attr('disabled','disabled');
        }
    });

    $("#questionid").on('change',function(){
        if($(this).val() != 'null')
        {
            display_question_stat($("#studyid").val(),$(this).val());
        }
        else
        {

        }
    });

});

