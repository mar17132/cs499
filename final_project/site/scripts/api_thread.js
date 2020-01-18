function secondThread()
{
    var w;
    if(typeof(Worker) !== "undefined")
    {
        if(typeof(w) == "undefined")
        {
            w = new Worker("");
            w.postMessage(true);
            w.onmessage = function(event){

                if(event.data.status == "done")
                {

                    w.terminate();
                }
                else
                {
                    console.log(event.data.data);
                    w.terminate();
                }
            };
        }
    }
}


