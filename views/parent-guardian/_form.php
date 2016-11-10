<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\FormGrid;
use kartik\builder\Form;
use kartik\widgets\SwitchInput;

$displayCourt = $model->pg_court_orders ? '' : 'none';
$form = ActiveForm::begin();
echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'contentBefore' => '<legend class="text-info"><small>FATHER</small></legend>',
            'attributes' => [
                'pg_father_first_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'First Name'],
                'pg_father_surname' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Surname'],
            ],
        ],
        [
            'attributes' => [
                'pg_father_contact_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Contact Number'],
                'pg_father_email' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Email'],
            ],
        ],
        [
            'contentBefore' => '<legend class="text-info"><small>MOTHER</small></legend>',
            'attributes' => [
                'pg_mother_first_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'First Name'],
                'pg_mother_surname' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Surname'],
            ],
        ],
        [
            'attributes' => [
                'pg_mother_contact_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Contact Number'],
                'pg_mother_email' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => ''], 'label' => 'Email'],
            ],
        ],
        [
            'contentBefore' => '<legend class="text-info"><small>DECLARATIONS:</small></legend>',
            'attributes' => [
                'pg_court_orders' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(),
                    'options' => [
                        'pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],
                        'pluginEvents' => ["switchChange.bootstrapSwitch" => "function(){showHideCourtOrderNote();}"]
                    ],
                    'label' => 'Are there any court orders (Custody / access restrictions etc.) pertaining to your child/children.'
                    ],
                'pg_court_order_note' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['style' => "display: $displayCourt;", 'placeholder' => ''], 'label' => 'If yes, please comment'],
            ],
        ],
        [
            'attributes' => [
                'pg_authorize_medical' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],], 'label' => 'In the event of an emergency the church may authorise on your child’s /
Children’s behalf whatever medical treatment he/she/they may require (this 
includes, but is not limited to, ambulance attendance). Do you give permission:'],
                'pg_photo_permission' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],], 'label' => 'In this technology age, photos and videos are often used as part of our church

program (e.g. website, newsletter) and are published in the wider community. Do 

you give permission for your child\'s / children’s photo to be published in any form?'],
            ],
        ],
        [
            'attributes' => [
                'pg_date' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DatePicker', 'hint' => '', 'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true, 'todayHighlight' => true]]],
                'pg_name_parent_guardian' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
            ],
        ],
    ]
]);

use kartik\tabs\TabsX;

echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'bordered' => true,
    'encodeLabels' => false,
    'items' => [
        [
            'label' => 'Children',
            'content' => $this->render('_child_grid', [
                'form' => $form,
                'model' => $model,
                'childMods' => $childMods,
            ])
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

    window.onload = function () {
        init();
    };

    function attachDatePickerForMDRows() {
        jQuery('#child-1-c_date_of_birth-kvdate').kvDatepicker(kvDatepicker_535b3809);
        jQuery('#child-2-c_date_of_birth-kvdate').kvDatepicker(kvDatepicker_535b3809);
        jQuery('#child-3-c_date_of_birth-kvdate').kvDatepicker(kvDatepicker_535b3809);
        jQuery('#child-4-c_date_of_birth-kvdate').kvDatepicker(kvDatepicker_535b3809);
        jQuery('#child-5-c_date_of_birth-kvdate').kvDatepicker(kvDatepicker_535b3809);

        jQuery("#child-1-c_behavioural_issue").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-2-c_behavioural_issue").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-3-c_behavioural_issue").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-4-c_behavioural_issue").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-5-c_behavioural_issue").bootstrapSwitch(bootstrapSwitch_8eaf19f3);

        jQuery("#child-1-c_toilet_trained").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-2-c_toilet_trained").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-3-c_toilet_trained").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-4-c_toilet_trained").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-5-c_toilet_trained").bootstrapSwitch(bootstrapSwitch_8eaf19f3);

        jQuery("#child-1-c_medical_conditions").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-2-c_medical_conditions").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-3-c_medical_conditions").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-4-c_medical_conditions").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        jQuery("#child-5-c_medical_conditions").bootstrapSwitch(bootstrapSwitch_8eaf19f3);
        
        jQuery("#child-1-c_active").bootstrapSwitch(bootstrapSwitch_6911520b);
        jQuery("#child-2-c_active").bootstrapSwitch(bootstrapSwitch_6911520b);
        jQuery("#child-3-c_active").bootstrapSwitch(bootstrapSwitch_6911520b);
        jQuery("#child-4-c_active").bootstrapSwitch(bootstrapSwitch_6911520b);
        jQuery("#child-5-c_active").bootstrapSwitch(bootstrapSwitch_6911520b);        
        
    }

    function attachDateTimePickerForMDRows() {
        jQuery('.detaildatetimepicker').parent().datetimepicker(datetimepicker_e8d09fe5)
    }

    function showHideCourtOrderNote() {
        if ($('#parentguardian-pg_court_orders').is(":checked")) {
            $('#parentguardian-pg_court_order_note').show();
        } else {
            $('#parentguardian-pg_court_order_note').hide();
        }        
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