<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\FormGrid;
use kartik\builder\Form;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use app\models\Grade;

$form = ActiveForm::begin();

echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'attributes' => [
                "c_parent_guardian_id" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '', 'class' => 'hidden'], 'label' => ''],
            ],
        ],
        [
            'attributes' => [
                "c_first_name" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                "c_surname" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
            ],
        ],
        [
            'attributes' => [
                "c_address" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                "c_suburb" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                "c_post_code" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
            ],
        ],
        [
            'attributes' => [
                "c_date_of_birth" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DatePicker', 'hint' => '', 'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true, 'todayHighlight' => true]]],
                "c_gender" => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ['M' => 'Male', 'F' => 'Female'], 'options' => ['placeholder' => '', 'prompt' => 'Select..']],
            ],
        ],
        [
            'attributes' => [
                "c_toilet_trained" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],],],
                "c_grade" => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Grade::find()->orderBy(['gd_sort_order' => SORT_ASC])->all(), 'gd_id', 'gd_name'), 'options' => ['placeholder' => '']],
            ],
        ],
        [
            'attributes' => [
                "c_medical_conditions" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => [
                        'pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],
                        'pluginEvents' => ["switchChange.bootstrapSwitch" => "function(){}"]
                    ], 'label' => 'Allergies / Medical conditions:'],
                "c_medical_condition_note" => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => ''], 'label' => 'If Yes, please comment:'],
            ],
        ],
        [
            'attributes' => [
                "c_behavioural_issue" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],], 'label' => 'Does your child have any behavioural / language issues:'],
                "c_behavioural_note" => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => ''], 'label' => 'If Yes, please comment:'],
            ],
        ],
        [
            'attributes' => [
                "c_active" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Active', 'offText' => 'Inactive', 'size' => 'large', 'onColor' => 'success', 'offColor' => 'danger',],],],
            ]
        ],
    ]
]);




?>  

<div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php
ActiveForm::end();
?>   

<script>
    window.onload = function () {
        init();
    };
    
    
    function attachDatePickerForMDRows() {
        jQuery('.detaildatepicker').parent().datepicker(datepicker_0bc58145);
    }

    function attachDateTimePickerForMDRows() {
        jQuery('.detaildatetimepicker').parent().datetimepicker(datetimepicker_e8d09fe5)
    }
    
    
   function init() {
        $('body').on('keydown', 'input, select, textarea', function (e) {
            var self = $(this)
                    , form = self.parents('form:eq(0)')
                    , focusable
                    , next
                    ;
            if (e.keyCode == 13) {
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit();
                }
                return false;
            }
        });
    }    
</script>