<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Session;

/**
 * SessionSearch represents the model behind the search form about `app\models\Session`.
 */
class SessionSearch extends Session
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ssn_id', 'ssn_marked_by'], 'integer'],
            [['ssn_name', 'ssn_date'], 'safe'],
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
        $query = Session::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
'sort' => [
                'defaultOrder' => ['ssn_date' => SORT_DESC],
            ],            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ssn_id' => $this->ssn_id,
            'ssn_date' => $this->ssn_date,
            'ssn_marked_by' => $this->ssn_marked_by,
        ]);

        $query->andFilterWhere(['like', 'ssn_name', $this->ssn_name]);

        return $dataProvider;
    }
}
