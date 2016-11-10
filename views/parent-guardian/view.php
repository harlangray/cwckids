<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParentGuardian */

$this->title = $model->pg_father_first_name;
$this->params['breadcrumbs'][] = ['label' => 'Enrolment Form', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="parent-guardian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pg_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('New Enrolment Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pg_id',
            'pg_father_first_name',
            'pg_father_surname',
            'pg_father_contact_number',
            'pg_father_email:email',
            'pg_mother_first_name',
            'pg_mother_surname',
            'pg_mother_contact_number',
            'pg_mother_email:email',
            [
                'attribute' => 'pg_court_orders',
                'format' => 'boolean'
            ],
            
            'pg_court_order_note:ntext',
            [
                'attribute' => 'pg_authorize_medical',
                'format' => 'boolean'
            ],            
            [
                'attribute' => 'pg_photo_permission',
                'format' => 'boolean'
            ],             
            
            'pg_date',
            'pg_name_parent_guardian',
        ],
    ]) ?>

</div>
