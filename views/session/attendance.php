<?php
use kartik\switchinput\SwitchInput;

?>
<table>
    <tr><th colspan="2"><h2>Attendance on <?= $model->ssn_date; ?></h2></th></tr>
    <tr><th colspan="2"><h4>Marked by <?= $model->markedBy->username; ?> </h4></tr>
    <tr>
        <th>Name</th>
        <th>Grade</th>
        <th>Present/Absent</th>
    </tr>
<?php
foreach ($sesAttendance as $index => $attendance){
    $child = $attendance->child;
    $childID = $child->c_id;
    ?>
    <tr>
        <th>
        <?= $child->c_first_name . ' ' . $child->c_surname; ?>
        </th>
        <td>
            <?= $child->grade->gd_name; ?>
        </td>
        <td style="vertical-align: middle;">
    <?php 
    echo SwitchInput::widget([

'name' => 'attendance_' . $index,
        'id' => 'attendance_' . $index,
        'value' => $attendance->sat_present,

        'inlineLabel' => true,
    'type' => SwitchInput::CHECKBOX,
        'pluginOptions'=>[
        'handleWidth'=>60,
        'onText'=>'Present',
        'offText'=>'Absent'
    ],
'pluginEvents' => ["switchChange.bootstrapSwitch" => "function(){markAttendance($index, $childID);}"]        
]);
        
    ?>
        </td>
</tr>

<?php
}
?>
</table>


<script>
    
    function markAttendance(index, childID){
        var sessionID = <?= $model->ssn_id ?>;
        var present;
        if($("#attendance_" + index).is(":checked")){
            present = 1;
        }
        else{
            present = 0;
        }
        
        $.ajax({
               url : '<?= yii::$app->urlManager->createUrl('session/markattendance') ?>',
               type : 'post',
               data : {
                   'sessionID' : sessionID,
                   'childID' : childID,
                   'present' : present
               }
           });
    }
</script>