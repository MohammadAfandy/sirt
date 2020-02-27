<?php
use app\models\Warga;
use yii\helpers\Html;
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

<div class="form-group">
    <div class="col-sm-5 pull-right">
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Selanjutnya', ['class' => 'btn btn-success']) ?>
    </div>
</div>
