function apiObjCall()
{

}


apiObjCall.prototype.getSongsLoop = function(){


    currentObj = this;
    xhttp = new XMLHttpRequest();
    jsonURL = this.apiUrl + this.trackEndpoint + "?apikey=" + this.apikey +
              "&format=jsonp&callback=callback&country=us&page=1&page_size=100&f_has_lyrics=1";
    xhttp.onreadystatechange = function(){

        if(this.readyState == 4 && this.status == 200)
        {
            if(currentObj.headerStatus(this.responseText) == 200)
            {
                currentObj.setResponsObj(this.responseText);
                currentObj.apiReturn();
            }
            else
            {
                postMessage({"status":"error","data":"Error: API Key"});
            }
        }
    };

    xhttp.open("GET",jsonURL,false);
    xhttp.send();

};




onmessage = function(event){
    var songsApiCall = new apiObjCall();
    this.postMessage({"status":"done","data":songsApiCall.songArray});
};
