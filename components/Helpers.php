<?php

namespace app\components;

use Yii;
use kartik\mpdf\Pdf;
use kongoon\orgchart\OrgChart;
use yii\web\UploadedFile;

use app\models\Warga;
use app\models\Rt;
use app\models\Rw;

use yii\helpers\Url;
use yii\helpers\Html;
/**
 * Class Helpers
 */
class Helpers extends \yii\base\Component
{

    /**
     * Generate View to PDF
     * @param view content
     * @param string dest
     * @param string filename
     * @param array options
     * @return pdf
     */
    public static function generatePdf($content, $dest, $filename = false, $options = [])
    {
        $params = [
            'filename' => $filename,
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => $dest,
            'content' => $content,
            // 'cssFile' => '@webroot/css/pdf.css',
            'options' => ['title' => 'Sistem Informasi RT'],
            'methods' => [ 
                'SetHeader'=>['Sistem Informasi RT'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ];

        $params = array_replace($params, $options);
        $pdf = new Pdf($params);
        return $pdf->render();
        exit();
    }

    /**
     * Generate Excel
     * @param string filename
     * @param array data
     * @param array style
     * @return excel
     */
    public static function generateExcel($filename, $data = [], $styles = [])
    {
        foreach ($data as $key => $dat) {
            $column = count($data[$key]['titles']);
            $row = count($data[$key]['data']) + 1;
            $all_cell = 'A1:' . chr($column + 64) . $row;
            $header_cell = 'A1:' . chr($column + 64) . '1';
            $content_cell = 'A2:' . chr($column + 64) . $row;

            // foreach ($styles as $old_key => $value) {
            //     $arr_key = explode('-', $old_key);

            //     if (strtolower($arr_key[0]) === 'col' && strtolower($arr_key[2]) === 'content') {
            //         $new_key = $arr_key[1] . '2:' . $arr_key[1] . $row;
            //         $styles[$new_key] = $value;
            //         unset($styles[$old_key]);
            //     }

            // }

            $data[$key]['styles'] = [
                $all_cell => [
                    'borders' => [
                        'allborders' => [
                            'style' => \PHPExcel_Style_Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ],
                ],
                $header_cell => [
                    'fill' => [
                        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                        'startcolor' => [
                            'argb' => 'd3d3d3',
                        ],
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                ],
                $content_cell => [
                    'font' => [
                        'size' => 11,
                    ],
                ],
            ];
            $data[$key]['on beforeRender'] = function ($event) use ($column) {
                for ($i = 65; $i < ($column + 65); $i++) {
                    $sheet = $event->sender->getSheet()->getColumnDimension(chr($i));
                    $sheet->setAutoSize(true);
                }
            };
            $data[$key]['styles'] = array_replace($data[$key]['styles'], $styles);
        }

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => $data,
        ]);

        $file->send($filename);
        exit();
    }

    /**
     * Convert date to date format Indonesia
     * @param string date
     * @return string result
     */
    public static function dateIndonesia($date) 
    {
        $result = '';
        if(!empty($date) && $date !== '0000-00-00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
            
        }
        return $result;
    }

    /**
     * Convert datetime to datetime format Indonesia
     * @param string date
     * @return string result
     */
    public static function dateTimeIndonesia($date) 
    {
        $result = '';
        if(!empty($date) && $date !== '0000-00-00 00:00:00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun.' - '.substr($date, 11, 19);
            
        }
        return $result;
    }

    /**
     * Generate Url from id warga
     * @param int id warga
     * @return string url
     */
    public static function getUrlWarga($id) 
    {
        if ($id) {
            return Html::a(self::getNamaWarga($id), Url::to(['warga/view', 'id' => $id]));   
        }

        return null;
    }

    /**
     * Get Jenis Kelamin
     * @param int id
     * @return string result
     */
    public static function getJenisKelamin($id) 
    {
        if ($id === 1) {
            return 'Laki - Laki';
        } else if ($id === 2) {
            return 'Perempuan';
        }

        return '';
    }

    /**
     * Get Nama Warga
     * @param int id_warga
     * @return string nama warga
     */
    public static function getNamaWarga($id_warga) 
    {
        $warga = Warga::findOne($id_warga);

        if (!empty($warga)) {
            return $warga->nama_warga;
        }

        return null;
    }

    /**
     * Get Nama Rt
     * @param int id_rt
     * @return string nama Rt
     */
    public static function getNamaRt($id_rt) 
    {
        $rw = Rt::findOne($id_rt);

        if (!empty($rw)) {
            return $rw->nama_rt;
        }

        return null;
    }

    /**
     * Get Nama RW
     * @param int id_rw
     * @return string nama rw
     */
    public static function getNamaRw($id_rw) 
    {
        $rw = Rw::findOne($id_rw);

        if (!empty($rw)) {
            return $rw->nama_rw;
        }

        return null;
    }

}