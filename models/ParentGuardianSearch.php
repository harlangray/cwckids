<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ParentGuardian;

/**
 * ParentGuardianSearch represents the model behind the search form about `app\models\ParentGuardian`.
 */
class ParentGuardianSearch extends ParentGuardian
{
    public $searchString;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pg_id', 'pg_court_orders', 'pg_authorize_medical', 'pg_photo_permission'], 'integer'],
            [['pg_father_first_name', 'pg_father_surname', 'pg_father_contact_number', 'pg_father_email', 'pg_mother_first_name', 'pg_mother_surname', 'pg_mother_contact_number', 'pg_mother_email', 'pg_court_order_note', 'pg_date', 'pg_name_parent_guardian', 'searchString'], 'safe'],
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
        $query = ParentGuardian::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pg_id' => $this->pg_id,
            'pg_court_orders' => $this->pg_court_orders,
            'pg_authorize_medical' => $this->pg_authorize_medical,
            'pg_photo_permission' => $this->pg_photo_permission,
            'pg_date' => $this->pg_date,
        ]);

        $query->andFilterWhere(['like', 'pg_father_first_name', $this->pg_father_first_name])
            ->andFilterWhere(['like', 'pg_father_surname', $this->pg_father_surname])
            ->andFilterWhere(['like', 'pg_father_contact_number', $this->pg_father_contact_number])
            ->andFilterWhere(['like', 'pg_father_email', $this->pg_father_email])
            ->andFilterWhere(['like', 'pg_mother_first_name', $this->pg_mother_first_name])
            ->andFilterWhere(['like', 'pg_mother_surname', $this->pg_mother_surname])
            ->andFilterWhere(['like', 'pg_mother_contact_number', $this->pg_mother_contact_number])
            ->andFilterWhere(['like', 'pg_mother_email', $this->pg_mother_email])
            ->andFilterWhere(['like', 'pg_court_order_note', $this->pg_court_order_note])
            ->andFilterWhere(['like', 'pg_name_parent_guardian', $this->pg_name_parent_guardian]);

  
        $query->orFilterWhere(['like', 'pg_father_first_name', $this->searchString])
            ->orFilterWhere(['like', 'pg_father_surname', $this->searchString])
            ->orFilterWhere(['like', 'pg_father_contact_number', $this->searchString])
            ->orFilterWhere(['like', 'pg_father_email', $this->searchString])
            ->orFilterWhere(['like', 'pg_mother_first_name', $this->searchString])
            ->orFilterWhere(['like', 'pg_mother_surname', $this->searchString])
            ->orFilterWhere(['like', 'pg_mother_contact_number', $this->searchString])
            ->orFilterWhere(['like', 'pg_mother_email', $this->searchString])
            ->orFilterWhere(['like', 'pg_court_order_note', $this->searchString])
            ->orFilterWhere(['like', 'pg_name_parent_guardian', $this->searchString]);
        
        return $dataProvider;
    }
}
