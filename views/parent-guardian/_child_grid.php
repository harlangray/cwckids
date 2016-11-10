<?php

use app\models\Child;
use yii\helpers\Html;
?>

    <div id="child_grid">


        <?php
        $index = 0;
        foreach ($childMods as $index => $childMod) {
            echo $this->render('_child_row', [
                'form' => $form,
                'childMod' => $childMod,
                'index' => $index,
            ]);
        }
        $childCnt = $index + 1;
        ?>
    </div>
    <div class="detail-button-panel">
        <?php
        echo Html::button('Add New', [ 'class' => 'btn btn-success glyphicon glyphicon-plus', 'onClick' => 'addchildRow();']);
        ?>    
    </div>



<script>
    var childCnt = <?= $childCnt; ?>;
    function addchildRow() {
<?php
$childMod = new Child();
$childMod->c_parent_guardian_id = isset($model->pg_id) ? $model->pg_id : 0;
$childMod->c_toilet_trained = 1;
$childMod->c_active = 1;

//$childMod->c_first_name = 'Hannah';
//$childMod->c_surname = 'Gray';
//$childMod->c_gender = 'M';
//$childMod->c_grade = 4;


$rowHtml = $this->render('_child_row', array('form' => $form,
    'childMod' => $childMod,
    'index' => '#replace#'));
//            $rowHtml = str_replace(array("\r\n", "\r", "\n"), "", $rowHtml);
//            $rowHtml = str_replace("'", "\"", $rowHtml);
?>
        rowHtml = <?= json_encode($rowHtml); ?>;

        rowHtml = rowHtml.replace(/#replace#/g, childCnt);
        childCnt++;

        $('#child_grid').append(rowHtml);
        attachDatePickerForMDRows();
        attachDateTimePickerForMDRows();
    }

    function removechildRow(id) {
        var row = $("#" + id);
        row.html('');
    }
    
    function showHideMedicalCondNote(index){
        alert(index);
        if ($('#child-' + index + '-c_medical_conditions').is(":checked")) {
            $('#child-' + index + '-c_medical_condition_note').show();
        } else {
            $('#child-' + index + '-c_medical_condition_note').hide();
        }        
    }        
</script>
