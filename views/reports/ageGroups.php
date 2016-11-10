<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<style>
/*    .reportHeading{
        font-size: 20px;
        text-align: center;
    }
    .firstName{
        width: 150px;
    }
    .sirName{
        width: 150px;
    }
    .medicalNote{
        width: 300px;
    }
    .dob{
        width: 120px;
    }
    .grade{
        width: 100px;
    }*/
</style>


<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $ageGrpArray = ['1' => 'Pre School',
                //'2' => 'Prep',
                '2' => 'Grade 1-3',
                '3' => 'Grade 4-6',
                ]
    ?>
    <?=
                $form->field($model, 'ageGroup')->dropDownList(
            $ageGrpArray); ?>
    
    <?=
$form->field($model, 'c_active')->dropDownList(
        [0 => 'No', 1 => 'Yes'], ['prompt' => 'All']);
?>
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
            Age Group - <?= $ageGrpArray[$model->ageGroup] ?>
        </th>
    </tr>
    <tr>
        <th class="reportHeaderRow firstName">First Name</th>
        <th class="reportHeaderRow sirName">Surname</th>
        <th class="reportHeaderRow grade">Grade</th>
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
        <td class='<?= $oddeven; ?>'><?= $model->grade->gd_name; ?></td>        
        <td class='<?= $oddeven; ?>'><?= $model->c_date_of_birth; ?></td>  
        <td class='<?= $oddeven; ?>'><?= $model->cParentGuardian->pg_name_parent_guardian; ?></td>
    </tr>
    <?php
}
?>
    
</table>