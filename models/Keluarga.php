<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%keluarga}}".
 *
 * @property int $id
 * @property string $no_kk
 * @property int $kepala_keluarga
 * @property string $anggota_keluarga json anggota keluarga
 * @property string $path_kk path upload kk
 * @property string $created_date
 * @property string $updated_date
 */
class Keluarga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%keluarga}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kk'], 'required'],
            [['kepala_keluarga'], 'integer'],
            [['anggota_keluarga', 'path_kk'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['no_kk'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_kk' => 'Nomor Kk',
            'kepala_keluarga' => 'Kepala Keluarga',
            'anggota_keluarga' => 'Anggota Keluarga',
            'path_kk' => 'Path Kk',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
