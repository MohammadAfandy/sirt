<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rt;
use app\models\Warga;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
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
            ->andFilterWhere(['in', 'ketua', $this->getFilterFieldWarga($this->ketua, 'ketua')])
            ->andFilterWhere(['in', 'wakil', $this->getFilterFieldWarga($this->wakil, 'wakil')])
            ->andFilterWhere(['in', 'sekretaris', $this->getFilterFieldWarga($this->sekretaris, 'sekretaris')])
            ->andFilterWhere(['in', 'bendahara', $this->getFilterFieldWarga($this->bendahara, 'bendahara')]);

        $dataProvider->setSort([
            'attributes' => [
                'nama_rt',
                'ketua' => [
                    'asc' => [$this->getSortWarga('ketua', 'asc')],
                    'desc' => [$this->getSortWarga('ketua', 'desc')],
                ],
                'wakil' => [
                    'asc' => [$this->getSortWarga('wakil', 'asc')],
                    'desc' => [$this->getSortWarga('wakil', 'desc')],
                ],
                'sekretaris' => [
                    'asc' => [$this->getSortWarga('sekretaris', 'asc')],
                    'desc' => [$this->getSortWarga('sekretaris', 'desc')],
                ],
                'bendahara' => [
                    'asc' => [$this->getSortWarga('bendahara', 'asc')],
                    'desc' => [$this->getSortWarga('bendahara', 'desc')],
                ],
            ],
        ]);

        return $dataProvider;
    }

    public function getArrIdInField($field)
    {
        if ($field) {
            $arr_id = ArrayHelper::map(self::find()->all(), 'id', $field);
            return $arr_id;
        }
        return null;
    }

    public function getFilterFieldWarga($attribute, $field)
    {
        if (!empty($attribute) && !empty(trim($field))) {
            $arr_id_warga = Warga::find()->select('id')
                                         ->andWhere(['in', 'id', $this->getArrIdInField($field)])
                                         ->andWhere(['LIKE', 'nama_warga', $attribute])
                                         ->all();

            $arr_id = ArrayHelper::map($arr_id_warga, 'id', 'id');
            if ($arr_id) {
                return $arr_id;
            }
            return false;
        }

        return null;
    }

    public function getSortWarga($field, $mode)
    {
        $sort = $mode === 'asc' ? SORT_ASC : SORT_DESC;
        if (!empty($field)) {
            $arr_id_warga = Warga::find()->select('id')
                                        ->andWhere(['in', 'id', $this->getArrIdInField($field)])
                                        ->orderBy(['nama_warga' => $sort])
                                        ->all();

            $arr_id_warga = ArrayHelper::map($arr_id_warga, 'id', 'id');

            if ($arr_id_warga) {
                $arr_id_warga = implode(',', $arr_id_warga);
                return new Expression("FIELD (`ketua`, " . $arr_id_warga . ")");
            }
        }

        return null;
    }
}
