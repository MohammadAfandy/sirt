<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Warga;
use kartik\select2\Select2;
?>

<div class="panel-body">
    <div class="warga-form">

        <?php
        $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
        ?>

        <?= $form->field($model, 'nama_warga')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'jenis_kelamin')->dropDownList(['1' => 'Laki - Laki', '2' => 'Perempuan'], ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'agama')->dropDownList(Warga::getAgama(), ['prompt' => '--PILIH-']) ?>

        <div class="form-group field-warga-tempat_lahir required">
            <label class="control-label col-sm-3" for="warga-tempat_lahir">Tempat / Tanggal Lahir</label>
            <div class="col-sm-4">
                <?= Html::activeTextInput($model, 'tempat_lahir', ['class' => 'form-control']) ?>
            </div>
            <div class="col-sm-2">
                <?= \yii\jui\DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'tgl_lahir',
                    'dateFormat' => 'yyyy-MM-dd',
                    'language' => 'id',
                    'options' => ['class' => 'form-control datepicker', 'readonly' => true],
                    'clientOptions' => [
                        'changeYear' => true,
                        'changeMonth' => true,
                        'yearRange' => '1900:now',
                        'maxDate' => 'now',
                    ],
                ]) ?>
            </div>
        </div>

        <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'id_rt')->dropDownList(ArrayHelper::map($list_rt, 'id', 'nama_rt'), ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'id_rw')->dropDownList(ArrayHelper::map($list_rw, 'id', 'nama_rw'), ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pekerjaan')->dropDownList(Warga::getPekerjaan(), ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'pendidikan')->dropDownList(Warga::getPendidikan(), ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'status_kawin')->dropDownList(Warga::getStatusKawin(), ['prompt' => '--PILIH-']) ?>

        <?= $form->field($model, 'path_ktp')->fileInput(['accept' => 'image/x-png, image/jpg, image/jpeg']) ?>

        <div class="form-group">
            <div class="col-sm-5 pull-right">
                <?= Html::a('Kembali', Yii::$app->request->referrer ? Yii::$app->request->referrer : ['index'], ['class' => 'btn btn-danger']) ?>
                <?= Html::submitButton(($model->isNewRecord) ? 'Tambah' : 'Update', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

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
    ',
    \yii\web\View::POS_READY,
    'form-warga-js'
);
?>
