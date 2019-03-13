<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rt;
use app\models\Warga;
use yii\helpers\ArrayHelper;
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
        ]);

        $query->andFilterWhere(['like', 'nama_rt', $this->nama_rt])
            ->andFilterWhere(['in', 'ketua', $this->getFilterNama($this->ketua, 'ketua')])
            ->andFilterWhere(['in', 'wakil', $this->getFilterNama($this->wakil, 'wakil')])
            ->andFilterWhere(['in', 'sekretaris', $this->getFilterNama($this->sekretaris, 'sekretaris')])
            ->andFilterWhere(['in', 'bendahara', $this->getFilterNama($this->bendahara, 'bendahara')]);

        return $dataProvider;
    }

    public function getFilterNama($attribute, $field)
    {
        if (!empty(trim($attribute)) && !empty(trim($field))) {
            $id_existing = ArrayHelper::map(self::find()->all(), 'id', $field);
            $id_warga = Warga::find()->select('id')
                                     ->andWhere(['in', 'id', $id_existing])
                                     ->andWhere(['LIKE', 'nama_warga', $attribute])
                                     ->all();

            $arr_id = ArrayHelper::map($id_warga, 'id', 'id');
            if ($arr_id) {
                return $arr_id;
            }
            return false;
        }

        return null;
    }
}
