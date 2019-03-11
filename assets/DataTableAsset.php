<?php

namespace app\assets;

use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/datatables/datatables';
    public $css = [
        'media/css/jquery.dataTables.min.css',
        // 'media/css/jquery.dataTables_themeroller.css',
        // 'media/css/dataTables.semanticui.min.css',
    ];
    public $js = [
        // 'media/js/dataTables.jqueryui.min.js',
        'media/js/jquery.dataTables.min.js',
    ];
}