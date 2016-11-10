<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


$form = ActiveForm::begin();
echo Form::widget([
    'model' => $model,
    'form' => $form,
    'columns' => 2,
    'attributes' => [
    'pg_father_first_name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_father_surname' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_father_contact_number' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_father_email' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_mother_first_name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_mother_surname' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_mother_contact_number' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_mother_email' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                'pg_court_orders' => ['type'=>Form::INPUT_CHECKBOX],
            
                'pg_court_order_note' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],
            
                'pg_authorize_medical' => ['type'=>Form::INPUT_CHECKBOX],
            
                'pg_photo_permission' => ['type'=>Form::INPUT_CHECKBOX],
            
                'pg_date' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','hint'=>'','options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose'=>true, 'todayHighlight' => true]]],
            
                'pg_name_parent_guardian' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],
            
                ]
]);
?>    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php
ActiveForm::end();
?>