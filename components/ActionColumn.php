<?php
namespace app\components;

use yii\grid\ActionColumn as BaseActionColumn;
use yii;
use yii\helpers\Html;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActionColumn
 *
 * @author harla
 */
class ActionColumn extends BaseActionColumn {
    //put your code here
    
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'View'),
                    'aria-label' => Yii::t('yii', 'View'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                
                $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/view.png', ['style' => 'margin: 3px;']);
                return Html::a($image, $url, $options);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/update.png', ['style' => 'margin: 3px;']);
                return Html::a($image, $url, $options);
                };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                $image = Html::img(yii::$app->urlManager->baseUrl . '/../images/delete.png', ['style' => 'margin: 3px;']);
                return Html::a($image, $url, $options);            };
        }
    }

}
