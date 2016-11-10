<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Child */

$this->title = 'Update Child: ' . ' ' . $model->c_first_name;
$this->params['breadcrumbs'][] = ['label' => 'Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c_first_name, 'url' => ['view', 'id' => $model->c_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
                    
    ]) ?>

</div>
