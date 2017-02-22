<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Grade;

?>
    <?php $form = ActiveForm::begin([ 'enableClientValidation' => true,
                'options'                => [
                    'id'      => 'dynamic-form'
                 ]]);
                ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Visiting Child</h4>
      </div>
      <div class="modal-body">
            <?php echo $form->field($model, 'c_first_name')->textInput(['maxlength' => true]) ?>
            <?php echo $form->field($model, 'c_surname')->textInput(['maxlength' => true]) ?>
          <?php echo $form->field($model, 'c_gender')->dropDownList(['M' => 'Male', 'F' => 'Female']);?>
          <?php echo $form->field($model, 'c_grade')->dropDownList(ArrayHelper::map(Grade::find()->orderBy(['gd_sort_order' => SORT_ASC])->all(), 'gd_id', 'gd_name')); ?>
          <?php echo $form->field($model, 'c_parent_guardian_name')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="modal-footer">
       <?php echo Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php ActiveForm::end(); ?>