<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<style>

</style>


<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $monthArr = ['1' => 'January',
                '2' => 'February',
                '3' => 'March',
                '4' => 'April',
                '5' => 'May',
                '6' => 'June',
                '7' => 'July',
                '8' => 'August',
                '9' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December'
                ];
    ?>
    <?= $form->field($model, 'birthdayMonth')->dropDownList(
            $monthArr); ?>
    
        <?= $form->field($model, 'c_active')->dropDownList(
            [0 => 'No', 1 => 'Yes'], ['prompt' => 'All']); ?>
    
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>

   
    <?php ActiveForm::end(); ?>
</div>

<?php

?>

<?php
$models = $dataProvider->getModels();
?>

<table class="reportTable">
    <tr>
        <th class="reportHeading" colspan="5">
            Birthdays in Month of <?= $monthArr[$model->birthdayMonth]; ?>
        </th>
    </tr>
    <tr>
        <th class="reportHeaderRow firstName">First Name</th>
        <th class="reportHeaderRow sirName">Surname</th>
        <th class="reportHeaderRow dob">DoB</th>
        <th class="reportHeaderRow parentGuardian">Parent/Guardian</th>
    </tr>
<?php
foreach ($models as $index => $model){
    $oddeven = ($index % 2)?'oddRow':'evenRow';
    ?>
    <tr>
        <td class='<?= $oddeven; ?>'><?= $model->c_first_name; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->c_surname; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->c_date_of_birth; ?></td>  
        <td class='<?= $oddeven; ?>'><?= $model->cParentGuardian->pg_name_parent_guardian; ?></td>
    </tr>
    <?php
}
?>
    
</table>