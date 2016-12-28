<?php
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SessionAttendance;
?>

    <?php $form = ActiveForm::begin(); ?>
<?php 
echo DatePicker::widget([
    'name' => 'fromDate',
    'id' => 'fromDate',
    'value' => $fromDate,
    'dateFormat' => 'yyyy-MM-dd',
]);

echo DatePicker::widget([
    'name' => 'toDate',
    'id' => 'toDate',
    'value' => $toDate,
    'dateFormat' => 'yyyy-MM-dd',
]);
?>

<?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

<table>
    <tr>
        <th class="reportHeaderRow fullName">Name</th>
        <?php
        foreach ($sessionCols as $field => $columnName){
            ?>
        <th class="reportHeaderRow date"><?= $columnName; ?></th>
        <?php
        }
        ?>
        <th class="reportHeaderRow date">Present</th>
        <th class="reportHeaderRow date">Absent</th>
        <th class="reportHeaderRow date">Percentage</th>
    </tr>
<?php

//die(print_r($result));
foreach ($result as $index => $row){
    $oddeven = ($index % 2)?'oddRow':'evenRow';
    
    $present = $row['present'];
    $absent = $row['absent'];
    $perc = $present / ($present + $absent) * 100;
    ?>
<tr>
<td class='<?= $oddeven; ?>'><?= $row['c_first_name'] ?> <?= $row['c_surname']; ?></td>
<?php
$imgPresent = Html::img(yii::$app->urlManager->baseUrl . '/../images/present.png');
$imgAbsent = Html::img(yii::$app->urlManager->baseUrl . '/../images/absent.png');

foreach ($sessionCols as $field => $columnName){
    ?>
<td class='<?= $oddeven; ?>'>
    <?php        
        $sessionID = $sessionColIDs[$field];
        $childID = $row['c_id'];
        $sessionAttendance = SessionAttendance::find()->where("sat_session_id = $sessionID AND sat_student_id = $childID")->one();
        if(!isset($sessionAttendance)){
            echo '_';
        }
        else{
            echo $row[$field]?$imgPresent:$imgAbsent;;
        }        
    ?>
    
</td>
<?php
}
?>
<td class='<?= $oddeven; ?>'><?= $present; ?></td>
<td class='<?= $oddeven; ?>'><?= $absent; ?></td>
<td class='<?= $oddeven; ?>'><?= number_format($perc, 0); ?> %</td>
</tr>
<?php
}
?>
</table>