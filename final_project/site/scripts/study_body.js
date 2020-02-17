
function getGroupId(currentObj)
{
    return currentObj.siblings("input[type=hidden]").val();
}

$(document).ready(function(){

    $(".study-table").on('click','.study-pop-btn',function(){
        secondThread({
            'url':'http://localhost/final_project/site/documents/partial/study_groups_table.php',
            database:{
                'id':getGroupId($(this))               
            },
            'type':'study',
            'refresh_type':'refresh',
            'page':'studygroup'
            }
        );
    })
});

