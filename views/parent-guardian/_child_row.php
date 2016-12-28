<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Grade;

$baseUrl = yii::$app->urlManager->getBaseUrl();
?>
<div id="child_row_<?= $index; ?>">
    <div class="panel panel-primary">
        <div class="panel-heading" style="height: 50px;">
            <div style="float: left">
                <h3 class="panel-title"><i class="glyphicon glyphicon-certificate"></i>Child Details</h3>            
            </div>

            <?php
            if($childMod->isNewRecord || count($childMod->sessionAttendance) == 0){
                ?>
            <a title="Remove" onclick="removechildRow('child_row_<?= $index ?>')" style="float: right;">
                <?php
                $options = '';
                echo Html::tag('div', Html::img($baseUrl . '/../images/close-me.png', $options), ['height' => '0px']);
                ?>
            </a>
            <?php
            }else{
            ?>
            <a title="This child cannot be removed because the child's attendance has been marked previously. If the child is no longer active, please deactivate the child."  style="float: right;">
                <?php
                $options = '';
                echo Html::tag('div', Html::img($baseUrl . '/../images/cannot-delete.png', $options), ['height' => '0px']);
                ?>
            </a>            
            <?php 
            }
            ?>
        </div>
        <?php

        use kartik\builder\FormGrid;
        use kartik\builder\Form;
        use kartik\widgets\SwitchInput;

echo FormGrid::widget([
            'model' => $childMod,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'attributes' => [
                        "[$index]c_parent_guardian_id" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '', 'class' => 'hidden'], 'label' => ''],
                        "[$index]c_id" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '', 'class' => 'hidden'], 'label' => ''],
                        
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_first_name" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                        "[$index]c_surname" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_address" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                        "[$index]c_suburb" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                        "[$index]c_post_code" => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => '']],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_date_of_birth" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\widgets\DatePicker', 'hint' => '', 'options' => ['pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true, 'todayHighlight' => true]]],
                        "[$index]c_gender" => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ['M' => 'Male', 'F' => 'Female'], 'options' => ['placeholder' => '', 'prompt' => 'Select..']],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_toilet_trained" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],],],
                        "[$index]c_grade" => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => ArrayHelper::map(Grade::find()->orderBy(['gd_sort_order' => SORT_ASC])->all(), 'gd_id', 'gd_name')],
//                        "[$index]c_grade" => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => [
//                            1 => 'pre school', 
//                            2 => '1',
//                            3 => '2',
//                            4 => '3',
//                            5 => '4',
//                            6 => '5',
//                            7 => '6',
//                            8 => '7',
//                            9 => '8',
//                            10 => '9',
//                            11 => '10',
//                            12 => '11',
//                            13 => '12'
//                            ], 
//                            'options' => ['placeholder' => '', 'prompt' => 'Select..']],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_medical_conditions" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => [
                            'pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],
                            'pluginEvents' => ["switchChange.bootstrapSwitch" => "function(){}"]
                            ], 'label' => 'Allergies / Medical conditions:'],                        
                        "[$index]c_medical_condition_note" => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => ''], 'label' => 'If Yes, please comment:'],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_behavioural_issue" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Yes', 'offText' => 'No',],], 'label' => 'Does your child have any behavioural / language issues:'],
                        "[$index]c_behavioural_note" => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => ''], 'label' => 'If Yes, please comment:'],
                    ],
                ],
                [
                    'attributes' => [
                        "[$index]c_active" => ['type' => Form::INPUT_WIDGET, 'widgetClass' => SwitchInput::className(), 'options' => ['pluginOptions' => ['onText' => 'Active', 'offText' => 'Inactive', 'size' => 'large', 'onColor' => 'success', 'offColor' => 'danger',],],],
                    ]
                ]
            ]
        ]);
        ?>

    </div>
</div>