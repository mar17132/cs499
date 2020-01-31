

function getFromApi(passData)
{
    let postURL = passData.url != null ? 
    passData.url : "http://localhost/final_project/api/scripts/api.call.php";
    let postData = passData.database;
    let thisPage = passData.page;

    if(postData)
    {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200)
            {   
                try
                {   
                    let jobj = JSON.parse(this.responseText);

                    jobj.page = thisPage;

                    postMessage(jobj);                                       
                }
                catch
                {
                    if(postData == 'refresh')
                    {
                        postMessage({"status":"good","results":"refresh",
                        "rows":this.responseText,'page':thisPage});
                    }                    
                    else
                    {
                        postMessage({"status":"error",
                        "results":"Bad return format",thisPage});
                    }

                }
            }
        };

        xhttp.open("POST",postURL,false);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send(object_to_string(postData));
    }
    else
    {
        postMessage({"status":"error","results":"Var not set"});
    }
}


function object_to_string(obj)
{
    let returnString = "";
    if(obj != "refresh")
    {
        let endKey = Object.keys(obj)[Object.keys(obj).length - 1];
        
        for(let key in obj)
        {
            returnString += key + "=" + obj[key];

            if(key != endKey)
            {
                returnString += "&";
            }    
        }
    }
    else
    {
        returnString = "";
    }

    return returnString;
}



onmessage = function(event){
   getFromApi(event.data);
};

