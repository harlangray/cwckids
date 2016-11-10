<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParentGuardian */

$this->title = 'Update Enrolment Form: ' . ' ' . $model->pg_father_first_name;
$this->params['breadcrumbs'][] = ['label' => 'Enrolment Form', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pg_father_first_name, 'url' => ['view', 'id' => $model->pg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="parent-guardian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'childMods' => $childMods,
            
    ]) ?>

</div>
