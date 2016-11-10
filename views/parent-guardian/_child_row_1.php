<?php



?>
<tr id="child_row_<?= $index; ?>">        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_id", ['template' => '{input}{hint}{error}'])->textInput(['readonly' => true, 'style' => 'width : 60px']); ?></td>
    <td class="v-align-top hidden"><?=$form->field($childMod, "[$index]c_parent_guardian_id", ['template' => '{input}{hint}{error}'])->textInput(['readonly' => true, 'style' => 'width : 60px']); ?></td>
    
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_first_name", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 50]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_surname", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 50]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_address", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 60]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_suburb", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 20]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_post_code", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 5]) ?></td>
        
    <td class="v-align-top"><?= ''
                ?>
                 <?php
    echo \kartik\date\DatePicker::widget([
        'model' => $childMod,
        'attribute' => "[$index]c_date_of_birth",
        'options' => ['placeholder' => 'Select date ...', 'class' => 'detaildatepicker'],
        'pluginOptions' => [      
            'todayHighlight' => true,
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'                    
        ]
]);
    ?>
    <?= ''
              ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_gender", ['template' => '{input}{hint}{error}'])->textInput(['maxlength' => 1]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_toilet_trained", ['template' => '{input}{hint}{error}'])->checkbox([], false) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_grade", ['template' => '{input}{hint}{error}'])->textInput() ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_medical_conditions", ['template' => '{input}{hint}{error}'])->checkbox([], false) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_medical_condition_note", ['template' => '{input}{hint}{error}'])->textarea(['rows' => 6]) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_behavioural_issue", ['template' => '{input}{hint}{error}'])->checkbox([], false) ?></td>
        
    <td class="v-align-top"><?=$form->field($childMod, "[$index]c_behavioural_note", ['template' => '{input}{hint}{error}'])->textarea(['rows' => 6]) ?></td>
        <td class="h-align-center">
        <a title="Remove" onclick="removechildRow('child_row_<?= $index ?>')">
            <span class="glyphicon glyphicon-trash"></span>
        </a>
    </td>      
</tr>
