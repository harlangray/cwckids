<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\ParentGuardian;
/* @var $this yii\web\View */
/* @var $model app\models\Child */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'c_parent_guardian_id')->dropDownList(ArrayHelper::map(ParentGuardian::find()->orderBy('pg_father_first_name')->asArray()->all(), 'pg_id', 'pg_father_first_name')) ?>

    <?= $form->field($model, 'c_first_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'c_surname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'c_address')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'c_suburb')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'c_post_code')->textInput(['maxlength' => 5]) ?>

    <?=  ''
                ?>
                 <?php
    echo Html::activeLabel($model,'c_date_of_birth');;
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'c_date_of_birth',
        'options' => ['placeholder' => 'Select date ...'],
        'pluginOptions' => [      
            'todayHighlight' => true,
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'                    
        ]
]);
    ?>
    <?= ''
              ?>

    <?= $form->field($model, 'c_gender')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'c_toilet_trained')->textInput() ?>

    <?= $form->field($model, 'c_grade')->textInput() ?>

    <?= $form->field($model, 'c_medical_conditions')->textInput() ?>

    <?= $form->field($model, 'c_medical_condition_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'c_behavioural_issue')->textInput() ?>

    <?= $form->field($model, 'c_behavioural_note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
