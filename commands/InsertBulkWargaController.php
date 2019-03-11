<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InsertBulkWargaController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $faker = \Faker\Factory::create('id_ID');
        $count = 0;
        for ($i = 0; $i < 30; $i++) {
            $warga = new \app\models\Warga();
            $warga->nama_warga = $faker->name;
            $warga->no_ktp = $faker->nik();
            $warga->jenis_kelamin = $faker->randomElement([1, 2]);
            $warga->agama = $faker->randomElement(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Budha', 'Kong Hu Cu']);
            $warga->tempat_lahir = $faker->city;
            $warga->tgl_lahir = $faker->dateTimeThisCentury->format('Y-m-d');
            $warga->alamat = $faker->address;
            $warga->id_rt = $faker->randomElement([5,6,7,8]);
            $warga->id_rw = 1;
            $warga->no_hp = $faker->phoneNumber;
            $warga->email = $faker->email;
            $warga->pekerjaan = $faker->randomElement([
                'Pegawai Swasta' => 'Pegawai Swasta',
                'Pegawai Negeri' => 'Pegawai Negeri',
                'Wiraswasta' => 'Wiraswasta',
                'Pelajar / Mahasiswa' => 'Pelajar / Mahasiswa',
                'Tidak Bekerja' => 'Tidak Bekerja',
            ]);
            $warga->pendidikan = $faker->randomElement([
                'S3' => 'S3',
                'S2' => 'S2',
                'S1' => 'S1',
                'SMA / SMK' => 'SMA / SMK',
                'SMP / MTS' => 'SMP / MTS',
                'SD / MA' => 'SD / MA',
            ]);
            $warga->status_kawin = $faker->randomElement([
                'Belum Menikah' => 'Belum Menikah',
                'Menikah' => 'Menikah',
                'Duda / Janda' => 'Duda / Janda',
            ]);

            if ($warga->save()) {
                $count++;
                // continue;
            }
        }

        echo "Berhasil Insert ".$count. " data";
    }
}
