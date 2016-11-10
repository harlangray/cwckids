<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('Create Session', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'app\components\ActionColumn',
                'template' => '{view}{update}{delete}{attendance}',
                'contentOptions' => ['style' => 'width: 250px;'],
                'header' => 'Actions',
                'buttons' => [
                    'attendance' => function($url, $model, $key) {
                        $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/attendance.png', ['style' => 'margin: 3px;']);
                        return Html::a($image, $url, ['title' => 'Mark Attendance']);
                    }
                        ],
                    ],
                    'ssn_id',
                    'ssn_name',
                    'ssn_date',
                    [
                        'attribute' => 'markedBySearch',
                        'value' => 'markedBy.username'
                    ],
                ],
            ]);
            ?>

</div>
