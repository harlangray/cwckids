<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\ParentGuardian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parent-guardian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pg_father_first_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'pg_father_surname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'pg_father_contact_number')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'pg_father_email')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'pg_mother_first_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'pg_mother_surname')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'pg_mother_contact_number')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'pg_mother_email')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'pg_court_orders')->textInput() ?>

    <?= $form->field($model, 'pg_court_order_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pg_authorize_medical')->textInput() ?>

    <?= $form->field($model, 'pg_photo_permission')->textInput() ?>

    <?=  ''
                ?>
                 <?php
    echo Html::activeLabel($model,'pg_date');;
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'pg_date',
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

    <?= $form->field($model, 'pg_name_parent_guardian')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
