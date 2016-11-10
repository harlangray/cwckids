<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Children';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
 
<div class="child-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'min-width:80px;']
            ],
            'c_id',
//            [
//                'attribute' => 'c_parent_guardian_id',
//                'value' => 'cParentGuardian.pg_father_first_name',
//            ],
            'c_first_name',
            'c_surname',
            'c_address',
            'c_suburb',
            'c_post_code',
            'c_date_of_birth',
            'c_gender',
            [
                'attribute' => 'c_toilet_trained',
                'format' => 'boolean',
                'filter' => [0 => 'No', 1 => 'Yes']
            ], 
            [
                'attribute' => 'grade',
                'value' => 'grade.gd_name'
                
            ],
            [
                'attribute' => 'c_medical_conditions',
                'format' => 'boolean',
                'filter' => [0 => 'No', 1 => 'Yes']
            ],
            [
                'attribute' => 'c_behavioural_issue',
                'format' => 'boolean',
                'filter' => [0 => 'No', 1 => 'Yes']
            ],
            [
                'attribute' => 'c_active',
                'format' => 'boolean',
                'filter' => [0 => 'No', 1 => 'Yes']
            ],
        ],
    ]);
    ?>

</div>
