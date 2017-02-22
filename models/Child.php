<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "child".
 *
 * @property integer $c_id
 * @property integer $c_parent_guardian_id
 * @property string $c_first_name
 * @property string $c_surname
 * @property string $c_address
 * @property string $c_suburb
 * @property string $c_post_code
 * @property string $c_date_of_birth
 * @property string $c_gender
 * @property integer $c_toilet_trained
 * @property integer $c_grade
 * @property integer $c_medical_conditions
 * @property string $c_medical_condition_note
 * @property integer $c_behavioural_issue
 * @property string $c_behavioural_note
 * @property string $c_parent_guardian_name
 * @property integer $c_active
 *
 * @property ParentGuardian $cParentGuardian
 */
class Child extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'child';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_parent_guardian_id', 'c_first_name', 'c_surname', 'c_gender', 'c_toilet_trained', 'c_grade', 'c_medical_conditions', 'c_behavioural_issue'], 'required'],
            [['c_parent_guardian_id', 'c_toilet_trained', 'c_grade', 'c_medical_conditions', 'c_behavioural_issue', 'c_active'], 'integer'],
            [['c_date_of_birth'], 'safe'],
            [['c_medical_condition_note', 'c_behavioural_note'], 'string'],
            [['c_first_name', 'c_surname', 'c_parent_guardian_name'], 'string', 'max' => 50],
            [['c_address'], 'string', 'max' => 60],
            [['c_suburb'], 'string', 'max' => 20],
            [['c_post_code'], 'string', 'max' => 5],
            [['c_gender'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_parent_guardian_id' => 'Parent Guardian',
            'c_first_name' => 'First Name',
            'c_surname' => 'Surname',
            'c_address' => 'Address',
            'c_suburb' => 'Suburb',
            'c_post_code' => 'Post Code',
            'c_date_of_birth' => 'Date Of Birth',
            'c_gender' => 'Gender',
            'c_toilet_trained' => 'Toilet Trained',
            'c_grade' => 'Grade',
            'c_medical_conditions' => 'Medical Conditions',
            'c_medical_condition_note' => 'Medical Condition Note',
            'c_behavioural_issue' => 'Behavioural Issue',
            'c_behavioural_note' => 'Behavioural Note',
            'c_parent_guardian_name' => 'Parent/Guardian Name',
            'c_active' => 'Active'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCParentGuardian() {
        return $this->hasOne(ParentGuardian::className(), ['pg_id' => 'c_parent_guardian_id']);
    }

    public function getGrade(){
        return $this->hasOne(Grade::className(), ['gd_id' => 'c_grade']);
    }
    
    public function getSessionAttendance(){
        return $this->hasMany(SessionAttendance::className(), ['sat_student_id' => 'c_id']);
    }

//        public function getUsedForAttendance(){
//        return ;
//    }
}
