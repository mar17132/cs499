
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
                //w.terminate();
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

            break;
            case 'interviews':

            break;
            case 'study':

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

            break;
            case 'interviews':

            break;
            case 'study':

            break;
            case 'index':

            break;
            default:
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









