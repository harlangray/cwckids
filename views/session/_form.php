<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Session */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ssn_name')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'ssn_date')->widget(DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
    ])
    ?>

    <?= ($model->isNewRecord)?$form->field($model, 'markPresentByDefault')->checkbox():''; ?>

        <?= $form->field($model, 'ssn_marked_by')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?= Html::submitButton($model->isNewRecord ? 'Create and Mark Attendance' : 'Update and Attendance', ['name' => 'saveandmark', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>
    

<?php ActiveForm::end(); ?>

</div>
