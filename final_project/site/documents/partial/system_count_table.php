
<?php 
require_once 'scripts/global_config.php';
require_once 'scripts/sessions.php';
require_once "scripts/api_connect.php"; 
?>

<?php

$responsArray = null;


function getRespon()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $groupsPop = new apiconnection();
    $groupsPop->setPage($myapiURL."api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'dashboard',
        'return_results'=>'getsystemcount'
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}

$responsArray = getRespon();

?>

<?php 

if(isset($responsArray['rows']))
{
    $systemCountArray = $responsArray['rows'][0];

?>

<table class="table table-striped system-count-table">
    <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Count</th>
        </tr>
    </thead> 
    <tbody>
        <tr>
            <td scope='row'>Study</td>
            <td >
                <?php echo $systemCountArray['study_count']; ?>
            </td>
        </tr>
        <tr>
            <td scope='row'>Population</td>
            <td >
                <?php echo $systemCountArray['pop_count']; ?>
            </td>
        </tr>
        <tr>
            <td scope='row'>Users</td>
            <td >
                <?php echo $systemCountArray['user_count']; ?>
            </td>
        </tr>
    </tbody>
</table>

<?php 

}
else
{
    echo "<h7>No records recorded.</h7>";
} 

?>
