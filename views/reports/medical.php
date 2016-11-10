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
        }*/
</style>

<?php
$models = $dataProvider->getModels();

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(); ?>
<?=
$form->field($model, 'c_active')->dropDownList(
        [0 => 'No', 1 => 'Yes'], ['prompt' => 'All']);
?>
<?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>

<table class="reportTable">
    <tr>
        <th class="reportHeading" colspan="5">
            Medical Report
        </th>
    </tr>
    <tr>
        <th class="reportHeaderRow firstName">First Name</th>
        <th class="reportHeaderRow sirName">Surname</th>
        <th class="reportHeaderRow medicalNote">Medical Note</th>
        <th class="reportHeaderRow dob">DoB</th>
        <th class="reportHeaderRow parentGuardian">Parent/Guardian</th>
    </tr>
    <?php
    foreach ($models as $index => $model) {
        $oddeven = ($index % 2) ? 'oddRow' : 'evenRow';
        ?>
        <tr>
            <td class='<?= $oddeven; ?>'><?= $model->c_first_name; ?></td>
            <td class='<?= $oddeven; ?>'><?= $model->c_surname; ?></td>
            <td class='<?= $oddeven; ?>'><?= $model->c_medical_condition_note; ?></td>
            <td class='<?= $oddeven; ?>'><?= $model->c_date_of_birth; ?></td>  
            <td class='<?= $oddeven; ?>'><?= $model->cParentGuardian->pg_name_parent_guardian; ?></td>
        </tr>
        <?php
    }
    ?>

</table>