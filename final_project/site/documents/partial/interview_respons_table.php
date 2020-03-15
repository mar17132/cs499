
<?php 
require_once '../../scripts/global_config.php';
require_once '../../scripts/sessions.php';
require_once "../../scripts/api_connect.php"; 
?>

<?php

$responsArray = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $responsArray = getRespon();
}

function getRespon()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $groupsPop = new apiconnection();
    $groupsPop->setPage($myapiURL."api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'interview',
        'return_results'=>'getrespons',
        'intid'=> $_POST['intid'],
        'studyid' => $_POST['studyid'],
        'uid' => $_POST['uid'],
        'popid' => $_POST['popid'],
        'groupid' => $_POST['groupid']
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}



?>

<?php 

if($responsArray['rows'][0]['status_complete'] ==  'Completed')
{

?>

<table class="table table-striped int-respons-table">
    <thead>
        <tr>
            <th scope="col">Question</th>
            <th scope="col">Answers</th>
        </tr>
    </thead> 
    <tbody>
        <?php

            $quesiontid = null;
            $countLoop = 0;
            $lastQuestType = null;

            function buildQuesiton($quest)
            {
                return "<td scope='row' >$quest</td>";
            }

            if($responsArray)
            {
  
                foreach($responsArray['rows'] as $row)
                {
                    
                           
                    if($quesiontid != $row['questid'])
                    {
                        if($countLoop > 0)
                        {
                            if($lastQuestType == 'checkbox')
                            {
                                echo "</td>";
                            }

                            echo "</tr>";
                        }

                        echo "<tr>";

                        echo buildQuesiton($row['question']);

                        if($row['checkbox_anwser'] != 'null')
                        {
                            echo "<td>";
                            echo $row['checkbox_anwser'];
                            $lastQuestType = 'checkbox';
                        }
                        else if($row['multi_anwser'] != 'null')
                        {
                            echo "<td>" . $row['multi_anwser']. "</td>";
                            $lastQuestType = null;
                        }
                        else if($row['fill_anwser'] != 'null')
                        {
                            echo "<td>" .$row['fill_anwser']. "</td>";
                            $lastQuestType = null;
                        }

                    }
                    else
                    {
                        
                        if($row['checkbox_anwser'] != 'null')
                        {
                            echo "</br>".$row['checkbox_anwser'];
                            $lastQuestType = 'checkbox';
                        }
                        else if($row['multi_anwser'] != 'null')
                        {
                            echo "<td>" . $row['multi_anwser']. "</td>";
                            $lastQuestType = null;
                        }
                        else if($row['fill_anwser'] != 'null')
                        {
                            echo "<td>" .$row['fill_anwser']. "</td>";
                            $lastQuestType = null;
                        }
                    }

                    $lastQuestType = $row['type'];
                    $quesiontid = $row['questid'];
                    $countLoop++;
                }

                echo "</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php 

}
else
{
    echo "<h7>No records recorded for this survey.</h7>";
} 

?>
