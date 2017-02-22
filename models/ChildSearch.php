<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Child;

/**
 * ChildSearch represents the model behind the search form about `app\models\Child`.
 */
class ChildSearch extends Child {

    public $searchString;
    public $birthdayMonth;
    public $ageGroup;
    public $grade;
    public $excludeIDs;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_id', 'c_parent_guardian_id', 'c_toilet_trained', 'c_grade', 'c_medical_conditions', 'c_behavioural_issue', 'c_active'], 'integer'],
            [['c_first_name', 'c_surname', 'c_address', 'c_suburb', 'c_post_code', 'c_date_of_birth', 'c_gender', 'c_medical_condition_note', 'c_behavioural_note', 'searchString', 'birthdayMonth', 'ageGroup', 'grade'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Child::find();

        $query->joinWith(['grade']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['c_date_of_birth' => SORT_DESC],
            ],
        ]);
        
        $dataProvider->sort->attributes['grade'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['grade.gd_name' => SORT_ASC],
        'desc' => ['grade.gd_name' => SORT_DESC],
        ];
        
//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }     
//        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
//die('aaa');
        $query->andFilterWhere([
            'c_id' => $this->c_id,
            'c_parent_guardian_id' => $this->c_parent_guardian_id,
            'c_date_of_birth' => $this->c_date_of_birth,
            'c_toilet_trained' => $this->c_toilet_trained,
            'c_grade' => $this->c_grade,
            'c_medical_conditions' => $this->c_medical_conditions,
            'c_behavioural_issue' => $this->c_behavioural_issue,
            'c_active' => $this->c_active,
        ]);

        $query->andFilterWhere(['like', 'c_first_name', $this->c_first_name])
                ->andFilterWhere(['like', 'c_surname', $this->c_surname])
                ->andFilterWhere(['like', 'c_address', $this->c_address])
                ->andFilterWhere(['like', 'c_suburb', $this->c_suburb])
                ->andFilterWhere(['like', 'c_post_code', $this->c_post_code])
                ->andFilterWhere(['like', 'c_gender', $this->c_gender])
                ->andFilterWhere(['like', 'c_medical_condition_note', $this->c_medical_condition_note])
                ->andFilterWhere(['like', 'c_behavioural_note', $this->c_behavioural_note])
                ->andFilterWhere(['like', 'grade.gd_name', $this->grade]);


        $query->orFilterWhere(['like', 'c_first_name', $this->searchString])
                ->orFilterWhere(['like', 'c_surname', $this->searchString])
                ->orFilterWhere(['like', 'c_address', $this->searchString])
                ->orFilterWhere(['like', 'c_suburb', $this->searchString])
                ->orFilterWhere(['like', 'c_post_code', $this->searchString])
                ->orFilterWhere(['like', 'c_gender', $this->searchString])
                ->orFilterWhere(['like', 'c_medical_condition_note', $this->searchString])
                ->orFilterWhere(['like', 'c_behavioural_note', $this->searchString]);

        if(count($this->excludeIDs) > 0){
            $query->andFilterWhere(['not in', 'c_id', $this->excludeIDs]);
        }
        
        if ($this->birthdayMonth > 0) {
            $query->andWhere("MONTH(c_date_of_birth) = {$this->birthdayMonth}");
        }

        if ($this->ageGroup == 1) {
            $query->andWhere("c_grade = 1 OR c_grade = 14"); //pre school, prep
        } elseif ($this->ageGroup == 2) {
            $query->andWhere("(c_grade = 2 OR c_grade = 3 OR c_grade = 4)");
        } elseif ($this->ageGroup == 3) {
            $query->andWhere("(c_grade = 5 OR c_grade = 6 OR c_grade = 7)");
        }
        return $dataProvider;
    }

    
}
