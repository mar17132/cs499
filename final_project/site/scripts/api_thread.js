/*function secondThread()
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
}*/



$("#delete_user_btn").on('click',function(){
    $.post("final_project/api/scripts/api.call.php",
        {
            'type':'user',
            'return_results':'delete',
            'uname':$("#delete_uname").val(),
            'uid':$("#delete_uid").val()
        },
        function(data,status,xhr){
            if(status == "success")
            {
                console.log(data);
            }
            else
            {
                console.log(status);
            }
    });
},"text");


