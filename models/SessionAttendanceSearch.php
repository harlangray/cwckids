<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SessionAttendance;

/**
 * SessionAttendanceSearch represents the model behind the search form about `app\models\SessionAttendance`.
 */
class SessionAttendanceSearch extends SessionAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sat_id', 'sat_session_id', 'sat_student_id', 'sat_present'], 'integer'],
            [['surnameSearch', 'firstNameSearch', 'gradeSearch'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SessionAttendance::find();
        $query->joinWith(['child', 'child.grade']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
//            'sort' => [
//                'defaultOrder' => ['child.c_surname' => SORT_ASC, 'child.c_first_name' => SORT_ASC]
//            ]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'surnameSearch' => [
                    'asc' => ['child.c_surname' => SORT_ASC],
                    'desc' => ['child.c_surname' => SORT_DESC],    
                    'default' => SORT_ASC
                ],
                'firstNameSearch' => [
                    'asc' => ['child.c_first_name' => SORT_ASC],
                    'desc' => ['child.c_first_name' => SORT_DESC],    
                    'default' => SORT_ASC
                ]                
            ],
            //'defaultOrder' => [ 'child.c_first_name' => SORT_ASC]
        ]);
        
//        $dataProvider->setSort([
//            'attributes' => [
//                'firstNameSearch' => [
//                    'asc' => ['child.c_first_name' => SORT_ASC],
//                    'desc' => ['child.c_first_name' => SORT_DESC],    
//                    'default' => SORT_DESC
//                ]
//            ]
//        ]);

//        $dataProvider->sort->attributes['surnameSearch'] = [
//        // The tables are the ones our relation are configured to
//        // in my case they are prefixed with "tbl_"
//        'asc' => ['child.c_surname' => SORT_ASC],
//        'desc' => ['child.c_surname' => SORT_DESC],
//        ];
        
//        $dataProvider->sort->attributes['firstNameSearch'] = [
//        // The tables are the ones our relation are configured to
//        // in my case they are prefixed with "tbl_"
//        'asc' => ['child.c_first_name' => SORT_ASC],
//        'desc' => ['child.c_first_name' => SORT_DESC],
//        ];        
        
        $dataProvider->sort->attributes['gradeSearch'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['grade.gd_name' => SORT_ASC],
        'desc' => ['grade.gd_name' => SORT_DESC],
        ];        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sat_id' => $this->sat_id,
            'sat_session_id' => $this->sat_session_id,
            'sat_student_id' => $this->sat_student_id,
            'sat_present' => $this->sat_present,
        ]);
        
        $query->andFilterWhere(['like', 'child.c_surname', $this->surnameSearch])
                ->andFilterWhere(['like', 'child.c_first_name', $this->firstNameSearch])
                ->andFilterWhere(['like', 'grade.gd_name', $this->gradeSearch]);

        return $dataProvider;
    }
}
