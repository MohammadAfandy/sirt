<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rw}}".
 *
 * @property int $id
 * @property string $nama_rw
 * @property int $ketua
 * @property int $wakil
 * @property int $penasehat
 * @property int $sekretaris
 * @property int $bendahara
 * @property string $seksi json seksi-seksi
 * @property string $alamat
 * @property string $awal_periode
 * @property string $akhir_periode
 * @property string $path_logo
 * @property string $created_date
 * @property string $updated_date
 */
class Rw extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rw}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_rw'], 'required'],
            [['ketua', 'wakil', 'penasehat', 'sekretaris', 'bendahara'], 'integer'],
            [['seksi', 'path_logo'], 'string'],
            [['awal_periode', 'akhir_periode', 'created_date', 'updated_date'], 'safe'],
            [['nama_rw'], 'string', 'max' => 10],
            [['alamat'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_rw' => 'Nama Rw',
            'ketua' => 'Ketua',
            'wakil' => 'Wakil',
            'penasehat' => 'Penasehat',
            'sekretaris' => 'Sekretaris',
            'bendahara' => 'Bendahara',
            'seksi' => 'Seksi',
            'alamat' => 'Alamat',
            'awal_periode' => 'Awal Periode',
            'akhir_periode' => 'Akhir Periode',
            'path_logo' => 'Path Logo',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
