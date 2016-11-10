<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParentGuardianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enrolment Form';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="parent-guardian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('New Enrolment Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'min-width:80px;']
                ],
            'pg_id',
            'pg_name_parent_guardian',
            'pg_father_first_name',
            'pg_father_surname',
            'pg_father_contact_number',
            'pg_father_email:email',
            'pg_mother_first_name',
            'pg_mother_surname',
            'pg_mother_contact_number',
            'pg_mother_email:email',
            /*            'pg_court_orders', */
            /*            'pg_court_order_note:ntext', */
            /*            'pg_authorize_medical', */
            /*            'pg_photo_permission', */
            'pg_date',
        ],
    ]);
    ?>

</div>
