<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParentGuardian */

$this->title = 'Add New Enrolment Form';
$this->params['breadcrumbs'][] = ['label' => 'Enrolment Form', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="parent-guardian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'childMods' => $childMods,
            
    ]) ?>

</div>
