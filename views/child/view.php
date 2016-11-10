<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Child */

$this->title = $model->c_first_name;
$this->params['breadcrumbs'][] = ['label' => 'Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="child-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->c_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->c_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'c_id',
            [
                'attribute' => 'c_parent_guardian_id',
                'value'=>$model->cParentGuardian->pg_father_first_name,
            ],
            'c_first_name',
            'c_surname',
            'c_address',
            'c_suburb',
            'c_post_code',
            'c_date_of_birth',
            'c_gender',
            [
                'attribute' => 'c_toilet_trained',
                'format' => 'boolean'
            ],            
            [
                'attribute' => 'c_grade',
                'value' => $model->grade->gd_name,
            ],
            [
                'attribute' => 'c_medical_conditions',
                'format' => 'boolean'
            ],                 
            'c_medical_condition_note:ntext',
            [
                'attribute' => 'c_behavioural_issue',
                'format' => 'boolean'
            ],               
            'c_behavioural_note:ntext',            
            [
                'attribute' => 'c_active',
                'value' => $model->c_active == 0?"Inactive":"Active",
            ]
        ],
    ]) ?>

</div>
