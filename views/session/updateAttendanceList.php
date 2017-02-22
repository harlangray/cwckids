<style>
    #attendancelist{
        width: 600px;
        display: inline-block;
        padding-right: 10px;
    }    
    #extralist{
        width: 500px;
        display: inline-block;
    }
</style>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance on ' . $session->ssn_date;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="session-index">

    <h2><?= 'Update Attendance List - <i>' . Html::encode($this->title) . '</i>' ?></h2>

    <p>
        <?= Html::a('Mark Attendance', ['attendance', 'id' => $session->ssn_id], ['class' => 'btn btn-success']) ?>



        <!--Crate new child-->

        <?php
        echo Html::a('Quick Add Child', ['/session/quickcreatechild', 'sessionID' => $session->ssn_id], [
            'class' => 'btn btn-primary',
            'title' => 'Add Child',
            'data-toggle' => 'modal',
            'data-target' => '#modalchild',
                ]
        );
        ?>
    </p>
    <!-----------------------> 


    <div class="modal remote fade" id="modalchild">
        <div class="modal-dialog">
            <div class="modal-content loader-lg"></div>
        </div>
    </div>

    <!--~~~~~~~~~~~~~~~~~~~~~-->

    <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>
    <div>
    <div id="attendancelist">
        <h3>Children in Attendance List</h3>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'app\components\ActionColumn',
                    'template' => '{delete}',
                    'contentOptions' => ['style' => 'width: 100px;'],
                    'header' => 'Remove',
                    'buttons' => [
                        'delete' => function($url, $model, $key) {
                            $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/close-me.png', ['style' => 'margin: 3px;']);
                            $url = yii::$app->urlManager->createUrl(['session/deletesessionattendance', 'id' => $key, 'sessionID' => $model->sat_session_id]);
                            return Html::a($image, $url, ['title' => 'Remove from List', 'data-confirm' => "Are you sure you want to remove this child from this attendance list?", 'data-method' => "post"]);
                        }
                            ]
                        ],
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
//            [
//                'header' => 'Remove',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    $baseUrl = yii::$app->urlManager->getBaseUrl();
//                    $options = '';
//                    return Html::tag('div', Html::img($baseUrl . '/../images/close-me.png', $options), ['height' => '0px', 'onClick' => "removeFromList($model->sat_id)"]);
//                }
//                    ]
                    ],
                ]);
                ?>

            </div>

            <div id="extralist">
                <h3>Children not in List</h3>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvNotInList,
                    'filterModel' => $searchNotInListMod,
                    'columns' => [
                        [
                            'class' => 'app\components\ActionColumn',
                            'template' => '{addtolist}',
                            'contentOptions' => ['style' => 'width: 100px;'],
                            'header' => 'Add',
                            'buttons' => [
                                'addtolist' => function($url, $model, $key) use ($session) {
                                    $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/add.png', ['style' => 'margin: 3px;']);
                                    $url = yii::$app->urlManager->createUrl(['session/addtosessionattendance', 'childID' => $key, 'sessionID' => $session->ssn_id]);
                                    return Html::a($image, $url, ['title' => 'Add to Attendance List', 'data-method' => "post"]);
                                }
                                    ]
                                ],
                                'c_first_name',
                                'c_surname',
                            ]
                                ]
                        );
                        ?>
                    </div>
    <div style="clear: both"></div>
    </div>
                </div>
                <script>

                    function removeFromList(sessionAttID) {
                        $.ajax({
                            url: '<?= yii::$app->urlManager->createUrl('session/removefromlist') ?>',
            type: 'post',
            data: {
                'sessionAttID': sessionAttID
            }
        });
    }
</script>