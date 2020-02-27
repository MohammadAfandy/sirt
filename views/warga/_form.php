<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Warga;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

app\assets\BsStepperAsset::register($this);
?>

<style>
    .step-trigger {
        font-size: 2rem !important;
    }
</style>

<div class="panel-body">
    <div class="bs-stepper">
        <div class="bs-stepper-header">
            <div class="step <?= $step >= 1 ? 'active' : '' ?>">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Data Diri</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step <?= $step >= 2 ? 'active' : '' ?>">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Alamat</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step <?= $step >= 3 ? 'active' : '' ?>">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">Preview</span>
                </button>
            </div>
        </div>
    </div>
    
    <div class="warga-form">

        <?php
        $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
        ?>

        <?= $this->render('form/_step' . $step, [
            'form' => $form,
            'model' => $model,
            'data' => $data,
        ]) ?>

        <?php
            Modal::begin(['id' => 'modal_foto', 'size' => 'modal-md']);
            echo '<img src="" class="foto">';
            Modal::end();
        ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>


<?php

$this->registerJs(
    '
    $(".datepicker").css({"cursor": "pointer", "background": "#fff"});

    $("#warga-no_hp").on("keydown", function(e) {
        if (e.keyCode > 57 || (106 < e.keyCode && (57 < e.keyCode < 96))) { 
            e.preventDefault();
        }
    });

    $(document).on("click", ".show-modal", function(e) {
        e.preventDefault();
        $("#modal_foto").modal("show").find(".foto").attr("src", $(this).attr("data-img-url"));
    });

    $("#ganti-foto").on("click", function() {
        $("#path-ktp").trigger("click");
    })
    ',
    \yii\web\View::POS_READY,
    'form-warga-js'
);
?>