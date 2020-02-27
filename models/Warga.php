<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\Rt;
use yii\web\UploadedFile;
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
 * @property string $created_date
 * @property string $updated_date
 */
class Warga extends \yii\db\ActiveRecord
{
    const SCENARIO_STEP1 = 'step1';
    const SCENARIO_STEP2 = 'step2';
    const SCENARIO_STEP3 = 'step3';

    private static $agama = [
        'Islam' => 'Islam',
        'Kristen Protestan' => 'Kristen Protestan',
        'Kristen Katolik' => 'Kristen Katolik',
        'Hindu' => 'Hindu',
        'Budha' => 'Budha',
        'Kong Hu Cu' => 'Kong Hu Cu',
    ];

    private static $pekerjaan = [
        'Pegawai Swasta' => 'Pegawai Swasta',
        'Pegawai Negeri' => 'Pegawai Negeri',
        'Wiraswasta' => 'Wiraswasta',
        'Pelajar / Mahasiswa' => 'Pelajar / Mahasiswa',
        'Tidak Bekerja' => 'Tidak Bekerja',
    ];

    private static $pendidikan = [
        'S3' => 'S3',
        'S2' => 'S2',
        'S1' => 'S1',
        'SMA / SMK' => 'SMA / SMK',
        'SMP / MTS' => 'SMP / MTS',
        'SD / MA' => 'SD / MA',
    ];

    private static $status_kawin = [
        'Belum Menikah' => 'Belum Menikah',
        'Menikah' => 'Menikah',
        'Duda / Janda' => 'Duda / Janda',
    ];

    protected $field_upload = [
        'ktp' => 'path_ktp',
    ];

    public $old_path_ktp;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%warga}}';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_STEP1 => ['nama_warga', 'no_ktp', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tgl_lahir', 'alamat'],
            self::SCENARIO_STEP2 => ['id_rt', 'id_rw', 'no_hp', 'email', 'pekerjaan', 'pendidikan', 'status_kawin', 'path_ktp'],
            self::SCENARIO_STEP3 => ['is_finish'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_warga', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tgl_lahir'], 'required', 'on' => [self::SCENARIO_STEP1]],
            [['pekerjaan', 'pendidikan', 'status_kawin', 'id_rt', 'id_rw'], 'required', 'on' => [self::SCENARIO_STEP2]],
            [['is_finish'], 'required', 'on' => [self::SCENARIO_STEP3]],
            [['nama_warga', 'tempat_lahir', 'alamat', 'no_ktp', 'email', 'no_hp'], 'trim'],
            [['no_ktp', 'alamat', 'no_ktp', 'no_hp', 'email', 'path_ktp',], 'default', 'value' => NULL],
            [['no_ktp'], 'unique'],
            [['step', 'is_finish', 'jenis_kelamin',], 'integer'],
            [['step', 'is_finish', 'tgl_lahir', 'created_date', 'updated_date'], 'safe'],
            [['alamat', 'path_ktp'], 'string'],
            [['nama_warga', 'email', 'pekerjaan'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['no_ktp'], 'string', 'max' => 30],
            [['agama', 'pendidikan'], 'string', 'max' => 20],
            [['tempat_lahir'], 'string', 'max' => 50],
            [['no_hp'], 'string', 'max' => 15],
            [['no_hp', 'no_ktp'], 'number'],
            [['path_ktp'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024000, 'tooBig' => 'Max 1 MB'],
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
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'id_rt' => 'RT',
            'id_rw' => 'RW',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'pekerjaan' => 'Pekerjaan',
            'pendidikan' => 'Pendidikan Terakhir',
            'status_kawin' => 'Status Perkawinan',
            'path_ktp' => 'Foto KTP',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public static function getAgama()
    {
        return self::$agama;
    }

    public static function getPekerjaan()
    {
        return self::$pekerjaan;
    }

    public static function getPendidikan()
    {
        return self::$pendidikan;
    }

    public static function getStatusKawin()
    {
        return self::$status_kawin;
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        $data_rt = Rt::find()->all();

        if ($data_rt) {
            $field_warga = Rt::getFieldWarga();
            foreach ($data_rt as $rt) {
                foreach ($field_warga as $field) {
                    if ($rt->$field == $this->id) {
                        $rt->$field = null;
                    }
                }
                $rt->save();
            }
        }
        return parent::beforeDelete();
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->old_path_ktp = $this->path_ktp;
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

    public function setStep($step)
    {
        $this->step = ($this->step < $step) ? $step : $this->step; 
    }


    public function saveUpload()
    {
        foreach ($this->field_upload as $attribute) {
            $upload = UploadedFile::getInstance($this, $attribute);

            if ($upload) {
                $dir_upload = $this->getUploadDir($attribute);
                $nama_warga = strtolower(str_replace(' ', '_', $this->nama_warga));
                $file_name = $this->no_ktp . '-' . $nama_warga . '.' . $upload->extension;

                if (!is_dir($dir_upload) && is_writable('uploads/')) {
                    mkdir($dir_upload, 0755, true);
                }

                $full_name = $dir_upload . $file_name;
                if ($upload->saveAs($full_name)) {  
                    $this->$attribute = $full_name;
                }
            }
        }
    }

    public function getUploadDir($attribute)
    {
        $nama_rw = strtolower(str_replace(' ', '_', Rw::findOne($this->id_rw)->nama_rw));
        $nama_rt = strtolower(str_replace(' ', '_', Rt::findOne($this->id_rt)->nama_rt));
        $dir_upload = '/uploads/' . $nama_rw . '/' . $nama_rt . '/' . array_search($attribute, $this->field_upload) . '/';

        return $dir_upload;
    }
}
