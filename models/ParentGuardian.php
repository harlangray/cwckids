<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parent_guardian".
 *
 * @property integer $pg_id
 * @property string $pg_father_first_name
 * @property string $pg_father_surname
 * @property string $pg_father_contact_number
 * @property string $pg_father_email
 * @property string $pg_mother_first_name
 * @property string $pg_mother_surname
 * @property string $pg_mother_contact_number
 * @property string $pg_mother_email
 * @property integer $pg_court_orders
 * @property string $pg_court_order_note
 * @property integer $pg_authorize_medical
 * @property integer $pg_photo_permission
 * @property string $pg_date
 * @property string $pg_name_parent_guardian
 */
class ParentGuardian extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'parent_guardian';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['pg_court_orders', 'pg_authorize_medical', 'pg_photo_permission', 'pg_date', 'pg_name_parent_guardian'], 'required'],
            [['pg_court_orders', 'pg_authorize_medical', 'pg_photo_permission'], 'integer'],
            [['pg_court_order_note'], 'string'],
            [['pg_date'], 'safe'],
            [['pg_father_first_name', 'pg_father_surname', 'pg_mother_first_name', 'pg_mother_surname'], 'string', 'max' => 100],
            [['pg_father_contact_number', 'pg_mother_contact_number'], 'string', 'max' => 15],
            [['pg_father_email', 'pg_mother_email'], 'string', 'max' => 60],
            [['pg_father_email', 'pg_mother_email'], 'email'],
            [['pg_name_parent_guardian'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'pg_id' => 'ID',
            'pg_father_first_name' => 'Father\'s First Name',
            'pg_father_surname' => 'Father\'s Surname',
            'pg_father_contact_number' => 'Father\'s Contact Number',
            'pg_father_email' => 'Father\'s Email',
            'pg_mother_first_name' => 'Mother\'s First Name',
            'pg_mother_surname' => 'Mother\'s Surname',
            'pg_mother_contact_number' => 'Mother\'s Contact Number',
            'pg_mother_email' => 'Mother\'s Email',
            'pg_court_orders' => 'Court Orders',
            'pg_court_order_note' => 'Court Order Note',
            'pg_authorize_medical' => 'Authorize Medical',
            'pg_photo_permission' => 'Photo Permission',
            'pg_date' => 'Date',
            'pg_name_parent_guardian' => 'Parent/Guardian',
        ];
    }

    public function getChildren() {
        return $this->hasMany(Child::className(), ['c_parent_guardian_id' => 'pg_id']);
    }   

    public function getFatherFullName(){
        return $this->pg_father_first_name . ' ' . $this->pg_father_surname;
    }
    
    public function getMotherFullName(){
        return $this->pg_mother_first_name . ' ' . $this->pg_mother_surname;
    }
    
    public function getListOfChildren(){
        $children = $this->children;
        foreach ($children as $child){
            $childArr[] = $child->c_first_name;
        }
        return implode(', ', $childArr);
    }
}
