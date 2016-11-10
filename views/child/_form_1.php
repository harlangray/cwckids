<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\FormGrid;
use kartik\builder\Form;

use yii\helpers\ArrayHelper;
use app\models\ParentGuardian;

$form = ActiveForm::begin();
echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
    
    
[
'attributes' => [
        'c_parent_guardian_id' => ['type'=>Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(ParentGuardian::find()->orderBy('pg_father_first_name')->asArray()->all(), 'pg_id', 'pg_father_first_name'),'options'=>['prompt' => 'Select...', 'placeholder'=>'']],

                        'c_first_name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'c_surname' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                ],
],
[
'attributes' => [
        'c_address' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'c_suburb' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'c_post_code' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                ],
],
[
'attributes' => [
        'c_date_of_birth' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','hint'=>'','options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose'=>true, 'todayHighlight' => true]]],

                        'c_gender' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'c_toilet_trained' => ['type'=>Form::INPUT_CHECKBOX],

                ],
],
[
'attributes' => [
        'c_grade' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'']],

                        'c_medical_conditions' => ['type'=>Form::INPUT_CHECKBOX],

                        'c_medical_condition_note' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

                ],
],
[
'attributes' => [
        'c_behavioural_issue' => ['type'=>Form::INPUT_CHECKBOX],

                        'c_behavioural_note' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],

                ],
],
   
    
    ]
]);



?>    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php
ActiveForm::end();
?>   

<script>
    function attachDatePickerForMDRows(){
        jQuery('.detaildatepicker').parent().datepicker(datepicker_0bc58145);
    } 
    
    function attachDateTimePickerForMDRows(){
        jQuery('.detaildatetimepicker').parent().datetimepicker(datetimepicker_e8d09fe5)
    }            
</script>