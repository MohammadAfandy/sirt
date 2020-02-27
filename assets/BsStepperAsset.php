<?php

namespace app\assets;

use yii\web\AssetBundle;

class BsStepperAsset extends AssetBundle
{
    public $css = [
        'library/bs-stepper/css/bs-stepper.min.css',
    ];
    public $js = [
        'library/bs-stepper/js/bs-stepper.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
