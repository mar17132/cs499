<?php

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';
require_once 'api.db_users.php';
require_once 'api.db_population.php';
require_once 'api.db_study.php';
require_once 'api.db_interview.php';
require_once 'api.db_dashboard.php';


if(!empty($_POST))
{
    //'type'=>'user','return_results'=>'login','uname'=>'dav'
    $dbObject->setConnection();

    if(!$dbObject->isDberror())
    {            
        switch($_POST['type'])
        {
            case 'user':
                usertype();
            break;
            case 'population':
                populationtype();
            break;
            case 'study':
                studytype();
            break; 
            case 'interview':
                interviewtype();
            break; 
            case 'dashboard':
                dashboardtype();
            break; 
            default:
                echo '{"status":"good","results":"Bad type"}';
            break;
        }

    }
    else
    {
        echo $dbObject->getDberror();
    }
}
else
{
    echo '{"status":"good","results":"No post"}';
}




function usertype()
{
    switch($_POST['return_results'])
    {
        case 'login':
            echo getUserLogin($_POST['uname']);
        break;
        case 'all':
            echo getAllUsers();
        break;
        case 'permissions':
            echo getUserPermission($_POST['userid']);
        break;
        case 'getStudyPermission':
            echo getStudyPermission($_POST['userid']);
        break;
        case 'permissionsUpdate':
            echo updateUserPermission($_POST['values']);
        break;
        case 'types':
            echo getUserTypes();
        break;
        case 'delete':
            echo deleteUser($_POST['uid'],$_POST['uname']);
        break;
        case 'update':
            echo updateUser($_POST['uid'],$_POST['uname'],
            $_POST['passwd'],$_POST['type_id']);
        break;
        case 'add':
            echo addUser($_POST['uname'],$_POST['passwd'],$_POST['type_id']);
        break;
        default:
            echo '{"status":"good","results":"Bad return type"}';
        break;     
    }
}


function populationtype()
{
    switch($_POST['return_results'])
    {
        case 'update':
            echo updatePop($_POST);
        break;
        case 'all':
            echo getAllPop();
        break;
        case 'allOfOne':
            echo getAllOfOnePop($_POST['popid'],$_POST['studyid'],$_POST['groupid']);
        break;
        case 'delete':
            echo deletePop($_POST['id']);
        break;
        case 'groupdelete':
            echo deleteGroup($_POST['id']);
        break;
        case 'addgroup':
            echo addGroup($_POST['name']);
        break;
        case 'add':
           echo addPop($_POST);
        break;
        case 'allgroups':
            echo getAllGroups();
         break;
         case 'groups':
            echo getPopGroups($_POST['id']); 
         break;
         case 'popgroupupdate':
            echo updatePopGroups($_POST['values']); 
         break;
        default:
            echo '{"status":"good","results":"Bad return"}';
        break;     
    }
}


function studytype()
{
    switch($_POST['return_results'])
    {
        case 'all':
            echo getAllStudy();
        break;
        case 'studygroups':
            echo getAllStudyGroups($_POST['id']);
        break;
        case 'types':
            echo getStudyTypes();
        break;
        case 'questiontype':
            echo getQuestionTypes();
        break;
        case 'add':
            echo addStudy($_POST);
        break;
        case 'update':
            echo updateStudy($_POST);
        break;
        case 'delete':
            echo deleteStudy($_POST['id']);
        break;
        case 'allquestions':
            echo allstudyQuestions($_POST['id']);
        break;
        case 'getquestion':
            echo getQuestion($_POST['studyid'],$_POST['questionid']);
        break;
        case 'removegroup':
            echo removegroup($_POST['groupid'],$_POST['studyid']); 
         break;
         case 'addgroup':
            echo connectGroup($_POST['groupid'],$_POST['studyid']); 
         break;
         case 'deletequestion':
            echo deleteQuestion($_POST['questionid']); 
         break;
         case 'removeanwser':
            echo removeanwser($_POST['answerid'],$_POST['questiontype']); 
         break;
         case 'addquestion':
            echo addquestion($_POST); 
         break;
         case 'updatequestion':
            echo updatequestion($_POST); 
         break;
        default:
            echo '{"status":"good","results":"Bad return"}';
        break;     
    }
}

function interviewtype()
{
    switch($_POST['return_results'])
    {
        case 'allque':
            echo getQueSurveys();
        break;
        case 'allprogress':
            echo getInProgresSurveys();
        break;
        case 'allcompleted':
            echo getCompleteSurveys();
        break;
        case 'getrespons':
            echo getInterviewRespons($_POST);
        break;
        case 'surveyquestions':
            echo getSurveyQuestions($_POST['studyid']);
        break;
        case 'completedtype':
            echo getCompletedTypes();
        break;
        case 'startcancelsurvey':
            echo startCancelSurvey($_POST['queid'],$_POST['uid'],$_POST['status']);
        break;
        case 'recordrespons':
            echo recordrespons($_POST['values']);
        break;
        case 'endsurvey':
            echo endsurvey($_POST['uid'],$_POST['queid'],
            $_POST['popid'],$_POST['studyid'],$_POST['groupid'],
            $_POST['endtype'],$_POST['surveyinterview']);
        break;
        default:
            echo '{"status":"good","results":"Bad return type"}';
        break;     
    }
}

function dashboardtype()
{
    switch($_POST['return_results'])
    {
        case 'getsystemcount':
            echo getsystemcount();
        break;
        case 'getstudystats':
            echo getstudystats();
        break;
        case 'questionstats':
            echo getquestionstats($_POST['studyid'],$_POST['questionid']);
        break;
        case 'questionselect':
            echo getquestionselect($_POST['studyid']);
        break;
        default:
            echo '{"status":"good","results":"Bad return type"}';
        break;     
    }
}

?>

