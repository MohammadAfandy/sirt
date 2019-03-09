<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_warga".
 *
 * @property int $id
 * @property string $nama_warga
 * @property string $no_ktp
 * @property int $jenis_kelamin 1 = Perempuan, 2 = Laki-Laki
 * @property string $agama
 * @property string $tempat_lahir
 * @property string $tgl_lahir
 * @property string $alamat json alamat
 * @property string $no_hp
 * @property string $email
 * @property string $pekerjaan
 * @property string $pendidikan
 * @property int $status_kawin 1=Belum Menikah, 2=Menikah, 3=Duda/Janda
 * @property string $path_ktp path upload ktp
 * @property int $id_keluarga
 * @property string $created_date
 * @property string $updated_date
 */
class Warga extends \yii\db\ActiveRecord
{

    static $agama = [
        'Islam' => 'Islam',
        'Kristen Protestan' => 'Kristen Protestan',
        'Kristen Katolik' => 'Kristen Katolik',
        'Hindu' => 'Hindu',
        'Budha' => 'Budha',
        'Kong Hu Cu' => 'Kong Hu Cu',
    ];

    static $pekerjaan = [
        'Pegawai Swasta' => 'Pegawai Swasta',
        'Pegawai Negeri' => 'Pegawai Negeri',
        'Wiraswasta' => 'Wiraswasta',
        'Pelajar / Mahasiswa' => 'Pelajar / Mahasiswa',
        'Tidak Bekerja' => 'Tidak Bekerja',
    ];

    static $pendidikan = [
        'S3' => 'S3',
        'S2' => 'S2',
        'S1' => 'S1',
        'SMA / SMK' => 'SMA / SMK',
        'SMP / MTS' => 'SMP / MTS',
        'SD / MA' => 'SD / MA',
    ];

    static $status_kawin = [
        'Belum Menikah' => 'Belum Menikah',
        'Menikah' => 'Menikah',
        'Duda / Janda' => 'Duda / Janda',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%warga}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_warga', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tgl_lahir', 'pekerjaan', 'pendidikan', 'status_kawin', 'id_rt', 'id_rw'], 'required'],
            [['jenis_kelamin', 'id_keluarga'], 'integer'],
            [['tgl_lahir', 'created_date', 'updated_date'], 'safe'],
            [['alamat', 'path_ktp'], 'string'],
            [['nama_warga', 'email', 'pekerjaan'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['no_ktp'], 'string', 'max' => 30],
            [['agama', 'pendidikan'], 'string', 'max' => 20],
            [['tempat_lahir'], 'string', 'max' => 50],
            [['no_hp'], 'string', 'max' => 15],
            [['no_hp', 'no_ktp'], 'number'],
            [['path_ktp'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024000, 'tooBig' => 'Max 1 MB'],
            [['no_kk'], 'exist', 'targetClass' => '\app\models\Keluarga'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_warga' => 'Nama Warga',
            'no_ktp' => 'No KTP',
            'no_kk' => 'No KK',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'id_rt' => 'RT',
            'id_rw' => 'RW',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'pekerjaan' => 'Pekerjaan',
            'pendidikan' => 'Pendidikan Terakhir',
            'status_kawin' => 'Status Perkawinan',
            'path_ktp' => 'Upload KTP',
            'id_keluarga' => 'ID Keluarga',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
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
