<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Child */

$this->title = 'Create Child';
$this->params['breadcrumbs'][] = ['label' => 'Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
                    
    ]) ?>

</div>
