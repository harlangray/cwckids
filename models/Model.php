<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Model extends \yii\base\Model {

    public static function createMultiple($modelClass, $multipleModels = null) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];
        $flag = false;
        $keyField = $modelClass::primaryKey()[0];
        if ($multipleModels !== null && is_array($multipleModels) && !empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, $keyField, $keyField));
            $multipleModels = array_combine($keys, $multipleModels);
            $flag = true;
        }
        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if ($flag) {
                    if (isset($item[$keyField]) && !empty($item[$keyField]) && isset($multipleModels[$item[$keyField]])) {
                        $models[$i] = $multipleModels[$item[$keyField]];
                    } else {
                        $models[$i] = new $modelClass;
                    }
                } else {
                    $models[$i] = new $modelClass;
                }
            }
        }
// echo '<pre>';
// var_dump($models);
// echo '</pre>';
//die();
        unset($model, $formName, $post);
        return $models;
    }

}

?>