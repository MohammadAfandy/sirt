<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
    private static $field_warga = [
        'ketua',
        'wakil',
        'sekretaris',
        'bendahara',
    ];
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
            [['nama_rt', 'alamat'], 'trim'],
            [['nama_rt', 'alamat'], 'default', 'value' => NULL],
            [['ketua', 'wakil', 'sekretaris', 'bendahara', 'id_rw'], 'integer'],
            [['seksi', 'path_logo'], 'string'],
            [['awal_periode', 'akhir_periode', 'created_date', 'updated_date'], 'safe'],
            [['nama_rt'], 'string', 'max' => 10],
            [['alamat'], 'string', 'max' => 255],
            [['wakil', 'sekretaris', 'bendahara'], 'compare', 'compareAttribute' => 'ketua', 'operator' => '!='],
            [['ketua', 'sekretaris', 'bendahara'], 'compare', 'compareAttribute' => 'wakil', 'operator' => '!='],
            [['ketua', 'wakil', 'bendahara'], 'compare', 'compareAttribute' => 'sekretaris', 'operator' => '!='],
            [['ketua', 'wakil', 'sekretaris'], 'compare', 'compareAttribute' => 'bendahara', 'operator' => '!='],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_rt' => 'RT',
            'ketua' => 'Ketua RT',
            'wakil' => 'Wakil Ketua RT',
            'sekretaris' => 'Sekretaris',
            'bendahara' => 'Bendahara',
            'seksi' => 'Seksi',
            'alamat' => 'Alamat Sekretariat',
            'awal_periode' => 'Awal Periode',
            'akhir_periode' => 'Akhir Periode',
            'id_rw' => 'RW',
            'path_logo' => 'Foto Logo',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public static function getFieldWarga()
    {
        return self::$field_warga;
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_date'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
