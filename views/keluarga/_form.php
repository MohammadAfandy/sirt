<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\components\Helpers;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body">
    <div class="keluarga-form">
        <fieldset class="fieldset">
            <legend><?= $model->isNewRecord ? "Tambah Data Keluarga" : "Update Data Keluarga" ?></legend>
            
            <?php
            $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
            ?>

            <?= $form->field($model, 'no_kk')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kepala_keluarga')->widget(Select2::classname(), [
                'data' => $list_warga,
                'language' => 'id',
                'options' => ['placeholder' => '--PILIH--'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>

            <div class="form-group">
                <label class="control-label col-sm-3">Anggota Keluarga</label>
                <div class="col-sm-6">
                    <?= Html::button(' Edit', ['class' => 'fa fa-pencil btn btn-info btn-sm pull-right show-modal']) ?>
                    <table id="tbl_anggota" class="table table-bordered">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <?php
            Modal::begin([
                'id' =>'modal_anggota',
                'size' => 'modal-lg',
                'header' => '<h2>Anggota Keluarga</h2>',
            ]);
            echo Yii::$app->controller->renderPartial('_modal_anggota', [
                'model' => $model,
                'list_warga' => $list_warga,
                'field_anggota' => $field_anggota,
            ]);
            Modal::end();
            ?>

            <?= $form->field($model, 'path_kk')->fileInput(['accept' => 'image/x-png, image/jpg, image/jpeg']) ?>

            <div class="form-group">
                <div class="col-sm-5 pull-right">
                    <?= Html::a('Kembali', Yii::$app->request->referrer ? Yii::$app->request->referrer : ['index'], ['class' => 'btn btn-danger']) ?>
                    <?= Html::submitButton(($model->isNewRecord) ? 'Tambah' : 'Update', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </fieldset>
    </div>
</div>

<?php
$this->registerJs(
    '
    initSelect();

    // get semua data warga yang sudah dipilih dari semua select2
    function getListWarga()
    {
        var warga_existing = [];

        $(".select2-hidden-accessible").each(function() {
            var data = $(this).select2("data");
            if (data.length > 0) {
                $.each(data, function(key, value) {
                    if (value.id != "") {
                        warga_existing.push(value.id);
                    }
                });
            }
        });

        return warga_existing;
    }

    // get data warga selain warga yang dipilih di select2
    function initSelect() {
        var warga_existing = getListWarga();
        var kepala_keluarga = "' . $model->kepala_keluarga . '";
        $.ajax({
            type: "POST",
            url: "' . \yii\helpers\Url::to(['ajax-select']) . '",
            data: {
                id: warga_existing,
                kepala_keluarga: kepala_keluarga
            },
            dataType: "json",
            beforeSend: function() { showLoading() },
            success: function(result) {
                $(".select2-hidden-accessible").each(function() {
                    var option = `<option value="">--PILIH--</option>`;
                    if ($(this).val() != "") {
                        var selected = $(this).find("option:selected");
                        selected.each(function() {
                            option += `<option value=` + $(this).attr("value") + ` selected>` + $(this).text() + `</option>`;
                        });
                    }
                    $.each(result, function(key, value) {
                        option += `<option value=` + key + `>` + value + `</option>`;
                    });
                    $(this).html(option);
                });
            },
            complete: function() { endLoading() }
        });
    }

    $(".select2-hidden-accessible").on("change", function() {
        initSelect();
    });

    $(".show-modal").on("click", function(e) {
        e.preventDefault();
        $("#modal_anggota").modal("show");
    });
    ',
    \yii\web\View::POS_READY,
    'form-keluarga-js'
);
?>