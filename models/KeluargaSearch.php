<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Keluarga;

/**
 * KeluargaSearch represents the model behind the search form of `app\models\Keluarga`.
 */
class KeluargaSearch extends Keluarga
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kepala_keluarga'], 'integer'],
            [['no_kk', 'path_kk', 'created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Keluarga::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kepala_keluarga' => $this->kepala_keluarga,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'no_kk', $this->no_kk])
            ->andFilterWhere(['like', 'path_kk', $this->path_kk]);

        return $dataProvider;
    }
}
