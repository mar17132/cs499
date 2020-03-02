
<?php 
require_once '../../scripts/global_config.php';
require_once '../../scripts/sessions.php';
require_once "../../scripts/api_connect.php"; 
?>

<?php

$responsArray = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $responsArray = (array) getRespon();
}

function getRespon()
{
    GLOBAL $jsonTophp;

    $groupsPop = new apiconnection();
    $groupsPop->setPage("final_project/api/scripts/api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'interview',
        'return_results'=>'surveyquestions',
        'studyid'=> $_POST['studyid']
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}



?>

<div class='container int-survey-info int-table-view'>

    <div class='row'>
        <div class='col'>
        Person: <span class='survey-popname int-survey-info-dis'>name</span>
        <input type='hidden' id='survey-popid' value='' />
        </div>

        <div class='col' >
        Phone:<span class='survey-popphone int-survey-info-dis'>this phone</span>
        </div>

        <div class='col-6' >
        Address:<span class='survey-popaddress int-survey-info-dis'>this address</span>
        </div>
    </div>

    <div class='row'>
        <div class='col'>
        Study: <span class='survey-popstudyname int-survey-info-dis'>Studyname</span>
        <input type='hidden' id='survey-studyid' value='' />
        </div>

        <div class='col' >
        Group:<span class='survey-popgroupname int-survey-info-dis'>this group</span>
        <input type='hidden' id='survey-groupid' value='' />
        </div>
        <div class='col-6'></div>
    </div>
</div>

<table class="table table-striped int-respons-table int-table-view">

    <tbody>
        <?php

            function bulidCheck($value,$anwser,$questid)
            {
                $returnString = "";

                $returnString .= "<li><input type='checkbox' value='";
                $returnString .= $value."' class='survey-anwsers' ";
                $returnString .= " id='".$anwser."' name='$questid'";
                $returnString .= "><label for='".$anwser."'>";
                $returnString .= "<span class='survey-ansers-display'>";
                $returnString .= $anwser."</span></label></li>";

                return $returnString;

            }

            function bulidMulti($value,$anwser,$questid)
            {
                $returnString = "";
                
                $returnString .= "<li><input type='radio' value='";
                $returnString .= $value."' class='survey-anwsers' ";
                $returnString .= " id='".$anwser."' name='$questid'";
                $returnString .= "><label for='".$anwser."'>";
                $returnString .= "<span class='survey-ansers-display'>";
                $returnString .= $anwser."</span></label></li>";

                return $returnString;
            }

            function bulidFill($anwser)
            {
                $returnString = "";

                $returnString .= "<li><input type='text' value='";
                $returnString .= $anwser."' class='survey-anwsers' >";
                $returnString .= "</li>";

                return $returnString;
            }

            if($responsArray)
            {
                $quesiontid = null;
                $countLoop = 0;

                foreach($responsArray['rows'] as $row)
                {
                    
                    if($quesiontid != $row['questid'])
                    {
                        if($countLoop > 0)
                        {
                            echo "</ul></div></td></tr>";
                        }

                        echo "<tr><td><div class='container' >";
                        echo $row['question']."</br>";
                        echo "<input type='hidden' class='survey-question' ";
                        echo "value='".$row['questid']."' />";
                        echo "<ul class='survey-anwser-ul'>";
                        
                       switch(trim($row['type']))
                        {
                            case 'Checkbox':
                                echo bulidCheck($row['checkbox_id'],$row['checkbox_anwser'],$row['questid']);
                            break;
                            case 'Fill in the blank':
                               echo bulidFill($row['checkbox_id'],$row['checkbox_anwser']);
                            break;
                            case 'Multiple Choice':
                              echo bulidMulti($row['multi_id'],$row['multi_anwser'],$row['questid']);
                            break;
                        }
                    }
                    else
                    {
                        switch(trim($row['type']))
                        {
                            case 'Checkbox':
                                echo bulidCheck($row['checkbox_id'],$row['checkbox_anwser'],$row['questid']);
                            break;
                            case 'Fill in the blank':
                                echo bulidFill($row['fill_anwser']);
                            break;
                            case 'Multiple Choice':
                                echo bulidMulti($row['multi_id'],$row['multi_anwser'],$row['questid']);
                            break;
                        }
                    }   

                    $countLoop++;
                    $quesiontid = $row['questid'];

                }

                echo "</ul></div></td></tr>";
            }
        ?>
    </tbody>
</table>

