
function secondThread(sendMessage,callback)
{
    let w;
    if(typeof(Worker) !== "undefined")
    {
        if(typeof(w) == "undefined")
        {
            w = new Worker("../scripts/api_thread.js");
            w.postMessage(sendMessage);
            w.onmessage = function(event){
                w.terminate();
                if(event.data.status == "good")
                {
                    threadReturn(event.data);
                    if(callback != null)
                    {
                        callback();
                    }
                }
                else
                {
                    console.log(event.data);  
                    displayError(event.data);               
                }
            };
        }

    }
}

function threadReturn(obj)
{
    if(obj.results == 'refresh')
    {
        switch(obj.page)
        {
            case 'users':
                userRefresh(obj.rows);
            break;
            case 'population':
                popRefresh(obj.rows);
            break;
            case 'groups':
                allGroupRefresh(obj.rows);
            break;
            case 'studygroup':
                studyGroupRefresh(obj.rows);
            break;
            case 'interviews':

            break;
            case 'study':
                studyRefresh(obj.rows);
            break;
            case 'studyquesiton':
                studyquesitonRefresh(obj.rows);
            break;
            case 'index':

            break;
            default:
        }
    }
    else if(obj.results == 'permissions')
    {
        switch(obj.page)
        {
            case 'users':
                UserPermisRefresh(obj.rows);
            break;
            case 'population':

            break;
            case 'interviews':

            break;
            case 'study':

            break;
            case 'index':

            break;
            default:
                displayError(Obj);
        }
    }
    else if(obj.results == 'groups')
    {
        switch(obj.page)
        {
            case 'users':
                //UserPermisRefresh(obj.rows);
            break;
            case 'population':
                popGroupRefresh(obj.rows);
            break;
            case 'interviews':

            break;
            case 'study':
                
            break;
            case 'index':

            break;
            default:
                displayError(Obj);
        }
    }
        else if(obj.results == 'groups')
    {
        switch(obj.page)
        {
            case 'users':
                //UserPermisRefresh(obj.rows);
            break;
            case 'population':
                popGroupRefresh(obj.rows);
            break;
            case 'interviews':

            break;
            case 'study':
                studyGroupRefresh(obj.rows);
            break;
            case 'index':

            break;
            default:
                displayError(Obj);
        }
    }
    else
    {
        switch(obj.page)
        {
            case 'users':
                displayInfo(obj);
            break;
            case 'population':
                displayInfo(obj);
            break;
            case 'interviews':

            break;
            case 'study':
                displayInfo(obj);
            break;
            case 'index':

            break;
            case 'questionEditrefresh':
                setQuestionEdit(obj.rows);
            break;
            default:
                displayError(obj);
        }
    }
}


function userRefresh(userObj)
{
    userTable = $(".user-table");
    //this will remove just the user table
    userTable.children(".userTable").remove();
    $(userObj).appendTo(userTable);
}

function UserPermisRefresh(userObj)
{
    userPermis = $(".user-permission-table");
    userPermis.empty();
    $(userObj).appendTo(userPermis);
}

function popRefresh(popObj)
{
    popContainer = $(".pop-table");
    //this will remove just the user table
    popContainer.children(".popTable").remove();
    $(popObj).appendTo(popContainer);
}

function popGroupRefresh(popObj)
{
   // console.log(popObj)
    popGroups = $(".pop-groups-table");
    popGroups.empty();
    $(popObj).appendTo(popGroups);
}

function allGroupRefresh(allgroupsObj)
{
   // console.log(popObj)
    allGroups = $(".pop-all-groups-table");
    allGroups.empty();
    $(allgroupsObj).appendTo(allGroups);
}

function studyGroupRefresh(allgroupsObj)
{
   // console.log(popObj)
    allGroups = $(".study-group-table");
    allGroups.empty();
    $(allgroupsObj).appendTo(allGroups);
}

function studyRefresh(studyObj)
{
   // console.log(popObj)
    allstudy = $(".study-table");
    allstudy.children(".studyTable").remove();
    $(studyObj).appendTo(allstudy);
}

function studyquesitonRefresh(studyObj)
{
   // console.log(popObj)
    allstudy = $(".study-quesiton-contain");
    allstudy.empty();
    $(studyObj).appendTo(allstudy);
}

function setQuestionEdit(qObj)
{
    dispalyEditQuestion(qObj);
}

function displayInfo(Obj)
{
    infoDiv = $("#informationMod");
    $(".informationMod-p").text(Obj.results);
    infoDiv.modal('show');
}

function displayError(Obj)
{
    infoDiv = $("#errorMod");
    $(".errorMod-p").text(Obj.results);
    infoDiv.modal('show');
}









