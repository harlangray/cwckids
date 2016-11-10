<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParentGuardianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parent-guardian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'pg_id') ?>

    <?php //$form->field($model, 'pg_father_first_name') ?>

    <?php //$form->field($model, 'pg_father_surname') ?>

    <?php //$form->field($model, 'pg_father_contact_number') ?>

    <?php //$form->field($model, 'pg_father_email') ?>

    <?php // echo $form->field($model, 'pg_mother_first_name') ?>

    <?php // echo $form->field($model, 'pg_mother_surname') ?>

    <?php // echo $form->field($model, 'pg_mother_contact_number') ?>

    <?php // echo $form->field($model, 'pg_mother_email') ?>

    <?php // echo $form->field($model, 'pg_court_orders') ?>

    <?php // echo $form->field($model, 'pg_court_order_note') ?>

    <?php // echo $form->field($model, 'pg_authorize_medical') ?>

    <?php // echo $form->field($model, 'pg_photo_permission') ?>

    <?php // echo $form->field($model, 'pg_date') ?>

    <?php // echo $form->field($model, 'pg_name_parent_guardian') ?>

<?php
echo $form->field($model, 'searchString')->textInput(['placeholder' => 'Search']);
?>    
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
