<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\switchinput\SwitchInput;

//use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance on ' . $session->ssn_date;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Marked by <?= $session->markedBy->username; ?> </h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
 
            [
                'attribute' => 'surnameSearch',
                'value' => 'child.c_surname'
            ],
            [
                'attribute' => 'firstNameSearch',
                'value' => 'child.c_first_name'
            ],
            [
                'attribute' => 'gradeSearch',
                'value' => 'child.grade.gd_name'
            ],
            [
                'attribute' => 'sat_present',                
                'format' => 'raw',
                'value' => function ($model) {
                    return SwitchInput::widget([

                                'name' => 'attendance_' . $model->sat_id,
                                'id' => 'attendance_' . $model->sat_id,
                                'value' => $model->sat_present,
                                'inlineLabel' => true,
                                'type' => SwitchInput::CHECKBOX,
                                'pluginOptions' => [
                                    'handleWidth' => 60,
                                    'onText' => 'Present',
                                    'offText' => 'Absent'
                                ],
                                'pluginEvents' => ["switchChange.bootstrapSwitch" => "function(){markAttendance($model->sat_id, $model->sat_student_id);}"]
                    ], TRUE);
                }
                    ]
                ],
            ]);
            ?>

        </div>



        <script>

            function markAttendance(index, childID) {
                var sessionID = <?= $session->ssn_id ?>;
                var present;
                if ($("#attendance_" + index).is(":checked")) {
                    present = 1;
                } else {
                    present = 0;
                }

                $.ajax({
                    url: '<?= yii::$app->urlManager->createUrl('session/markattendance') ?>',
            type: 'post',
            data: {
                'sessionID': sessionID,
                'childID': childID,
                'present': present
            }
        });
    }
</script>