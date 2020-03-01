
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

<table class="table table-striped int-respons-table">

    <tbody>
        <?php

            function bulidCheck($value,$anwser)
            {
                $returnString = "";

                $returnString .= "<li><input type='checkbox' value='";
                $returnString .= $value."' class='survey-anwsers' >";
                $returnString .= $anwser."</li>";

                return $returnString;

            }

            function bulidMulti($value,$anwser)
            {
                $returnString = "";
                
                $returnString .= "<li><input type='radio' value='";
                $returnString .= $value."' class='survey-anwsers' >";
                $returnString .= $anwser."</li>";

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
                            echo "</ul></div>";
                        }

                        echo "<div class='container' >";
                        echo $row['question']."</br>";
                        echo "<input type='hidden' class='survey-question' ";
                        echo "value='".$row['questid']."' /><ul>";
                        
                       switch(trim($row['type']))
                        {
                            case 'Checkbox':
                                echo bulidCheck($row['checkbox_id'],$row['checkbox_anwser']);
                            break;
                            case 'Fill in the blank':
                               echo bulidFill($row['checkbox_id'],$row['checkbox_anwser']);
                            break;
                            case 'Multiple Choice':
                              echo bulidMulti($row['multi_id'],$row['multi_anwser']);
                            break;
                        }
                    }
                    else
                    {
                        switch(trim($row['type']))
                        {
                            case 'Checkbox':
                                echo bulidCheck($row['checkbox_id'],$row['checkbox_anwser']);
                            break;
                            case 'Fill in the blank':
                                echo bulidFill($row['fill_anwser']);
                            break;
                            case 'Multiple Choice':
                                echo bulidMulti($row['multi_id'],$row['multi_anwser']);
                            break;
                        }
                    }   

                    $countLoop++;
                    $quesiontid = $row['questid'];

                }

                echo "</ul></div>";
            }
        ?>
    </tbody>
</table>

