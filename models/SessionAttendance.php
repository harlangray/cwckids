<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session_attendance".
 *
 * @property integer $sat_id
 * @property integer $sat_session_id
 * @property integer $sat_student_id
 * @property integer $sat_present
 */
class SessionAttendance extends \yii\db\ActiveRecord
{
        public $surnameSearch;
        public $firstNameSearch;
        public $gradeSearch;
        
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session_attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sat_session_id', 'sat_student_id', 'sat_present'], 'required'],
            [['sat_session_id', 'sat_student_id', 'sat_present'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sat_id' => 'Sat ID',
            'sat_session_id' => 'Session ID',
            'sat_student_id' => 'Student ID',
            'sat_present' => 'Present/Absent',
            
            'surnameSearch' => 'Surname',
            'firstNameSearch' => 'First Name',
            'gradeSearch' => 'Grade'
        ];
    }
    
    public function getChild(){
        return $this->hasOne(Child::className(), ['c_id' => 'sat_student_id']);
    }
}
