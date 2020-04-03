

function getFromApi(passData)
{

    const myURLThread = "http://localhost/final_project/site";
    const myapiURLThread = "http://localhost/final_project/api/scripts/";
    //const myURLThread = "https://csfinal.erawsoft.com";
    //const myapiURLThread = "https://erawsoft.com/";

    //let postURL = passData.url != null ? 
    //passData.url : myapiURLThread + "api.call.php";

    let postURL = passData.url != null ? 
    passData.url : myURLThread + "/scripts/get_api_data.php";
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
                        postMessage({"status":"good","results":'refresh',
                        "rows":this.responseText,'page':thisPage});
                    } 
                    else if(passData.refresh_type != null)
                    {
                        postMessage({"status":"good","results":passData.refresh_type,
                        "rows":this.responseText,'page':thisPage});
                    }                    
                    else
                    {
                        postMessage({"status":"error",
                        "results":"Bad return format","page":thisPage,"text":this.responseText});
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
            if(key != 'values')
            {
                returnString += key + "=" + obj[key];
            }
            else if(key == 'values')
            {
                for(let i = 0; i < obj[key].length; i++)
                {
                    returnString += key + "["+i+"]=" + object_to_array_string(obj[key][i]);

                    if((i + 1) != obj[key].length)
                    {
                        returnString += "&";
                    }
                }
            } 
            
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

function object_to_array_string(objArray)
{
    //name=Actor1,
    let returnString = "";

    let endKey = Object.keys(objArray)[Object.keys(objArray).length - 1];
    
    for(let key in objArray)
    {
        objString = objArray[key].trim();
        returnString += objString.replace("\n","");

        if(key != endKey)
        {
            returnString += ",";
        }    
    }
    
    return returnString;
}



onmessage = function(event){
   getFromApi(event.data);
};

