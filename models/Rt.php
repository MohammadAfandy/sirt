<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_rt".
 *
 * @property int $id
 * @property string $nama_rt
 * @property int $ketua
 * @property int $wakil
 * @property int $sekretaris
 * @property int $bendahara
 * @property string $seksi json seksi-seksi
 * @property string $alamat
 * @property string $awal_periode
 * @property string $akhir_periode
 * @property int $id_rw
 * @property string $path_logo
 * @property string $created_date
 * @property string $updated_date
 */
class Rt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rt}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_rt'], 'required'],
            [['ketua', 'wakil', 'sekretaris', 'bendahara', 'id_rw'], 'integer'],
            [['seksi', 'path_logo'], 'string'],
            [['awal_periode', 'akhir_periode', 'created_date', 'updated_date'], 'safe'],
            [['nama_rt'], 'string', 'max' => 10],
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
            'nama_rt' => 'Nama Rt',
            'ketua' => 'Ketua',
            'wakil' => 'Wakil',
            'sekretaris' => 'Sekretaris',
            'bendahara' => 'Bendahara',
            'seksi' => 'Seksi',
            'alamat' => 'Alamat',
            'awal_periode' => 'Awal Periode',
            'akhir_periode' => 'Akhir Periode',
            'id_rw' => 'Id Rw',
            'path_logo' => 'Path Logo',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
