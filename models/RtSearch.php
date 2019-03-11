<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rt;

/**
 * RtSearch represents the model behind the search form of `app\models\Rt`.
 */
class RtSearch extends Rt
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rw'], 'integer'],
            [['nama_rt', 'ketua', 'wakil', 'sekretaris', 'bendahara', 'id_rw', 'awal_periode', 'akhir_periode'], 'safe'],
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
    public function search($id_rw, $params)
    {
        $query = Rt::find()->where(['id_rw' => $id_rw]);

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
            // 'id' => $this->id,
            // 'ketua' => $this->ketua ? Warga::find()->where(['and', ['like', 'nama_warga', $this->ketua], ['id_rw' => $id_rw]])->one()->id : $this->ketua,
            // 'wakil' => $this->wakil,
            // 'sekretaris' => $this->sekretaris,
            // 'bendahara' => $this->bendahara,
        ]);

        $query->andFilterWhere(
            ['like', 'nama_rt', $this->nama_rt],
            // ['like', 'ketua', Warga::find()->where(['and', ['like', 'nama_warga', $this->ketua], ['id_rw' => $id_rw]])->one()->id_warga],
        );

        return $dataProvider;
    }

    // public function 
}
