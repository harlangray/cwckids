<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;
/**
 * This is the model class for table "session".
 *
 * @property integer $ssn_id
 * @property string $ssn_name
 * @property string $ssn_date
 * @property integer $ssn_marked_by
 */
class Session extends \yii\db\ActiveRecord
{
    public $children = [];
    public $markPresentByDefault;
    public $markedBySearch;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ssn_name', 'ssn_date', 'ssn_marked_by'], 'required'],
            [['ssn_date', 'markPresentByDefault'], 'safe'],
            [['ssn_marked_by', 'markPresentByDefault'], 'integer'],
            [['ssn_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ssn_id' => 'ID',
            'ssn_name' => 'Name',
            'ssn_date' => 'Date',
            'ssn_marked_by' => 'Marked By',
            'markedBySearch' => 'Marked By',

        ];
    }
    
    public function getAttendance(){
        //return $this->hasMany(SessionAttendance::className(), ['ssn_id' => 'sat_session_id']);
        $marked = $this->hasMany(Child::className(), ['ssn_id' => 'sat_session_id'])->viaTable('session_attendance', ['sat_student_id' => 'c_id']);
        $allChildren = Child::find()->where("c_active  = 1")->all();
        
        foreach ($allChildren as $child){
            $child->attendanceMarked = 0;
        }
        
        return $allChildren;
    }
    
    public function getSessionAttendance(){
        return $this->hasMany(SessionAttendance::className(), ['sat_session_id' => 'ssn_id']);
    }
    
    public function getMarkedBy(){
        return $this->hasOne(User::className(), ['id' => 'ssn_marked_by']);
    }
}
