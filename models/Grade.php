<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property integer $gd_id
 * @property string $gd_name
 * @property integer $gd_sort_order
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gd_name', 'gd_sort_order'], 'required'],
            [['gd_sort_order'], 'integer'],
            [['gd_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gd_id' => 'ID',
            'gd_name' => 'Name',
            'gd_sort_order' => 'Sort Order',
        ];
    }
}
