<?php
use app\models\Warga;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>

<?= $form->field($model, 'id_rt')->dropDownList(ArrayHelper::map($data['list_rt'], 'id', 'nama_rt'), ['prompt' => '--PILIH-']) ?>

<?= $form->field($model, 'id_rw')->dropDownList(ArrayHelper::map($data['list_rw'], 'id', 'nama_rw'), ['prompt' => '--PILIH-']) ?>

<?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'pekerjaan')->dropDownList(Warga::getPekerjaan(), ['prompt' => '--PILIH-']) ?>

<?= $form->field($model, 'pendidikan')->dropDownList(Warga::getPendidikan(), ['prompt' => '--PILIH-']) ?>

<?= $form->field($model, 'status_kawin')->dropDownList(Warga::getStatusKawin(), ['prompt' => '--PILIH-']) ?>

<?php if ($model->path_ktp) : ?>
    <div class="form-group field-warga-path_ktp">
        <label class="control-label col-sm-3" for="warga-path_ktp">Tempat / Tanggal Lahir</label>
        <div class="col-sm-4">
            <?= Html::button('Lihat', ['data-img-url' => $model->path_ktp, 'class' => 'btn btn-success show-modal']) ?>
            <?= Html::button('Ganti Foto', ['class' => 'btn btn-info', 'id' => 'ganti-foto']) ?>
            <?= Html::activeFileInput($model, 'old_path_ktp', [
                'accept' => 'image/x-png, image/jpg, image/jpeg',
                'class' => 'hide',
                'id' => 'path-ktp'
            ]) ?>
            <?= Html::error($model, 'path_ktp', ['style' => 'color:red']) ?>
        </div>
    </div>
<?php else : ?>
    <?= $form->field($model, 'path_ktp')->fileInput(['accept' => 'image/x-png, image/jpg, image/jpeg']) ?>
<?php endif; ?>

<div class="form-group">
    <div class="col-sm-5 pull-right">
        <?= Html::a('Sebelumnya', ['create', 'step' => 1, 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Selanjutnya', ['class' => 'btn btn-success']) ?>
    </div>
</div>