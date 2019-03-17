<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\components\Helpers;
use app\models\Rt;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
?>

<div class="panel-body">
    <div class="rt-form">
        <fieldset class="fieldset">
            <legend><?= $model->isNewRecord ? "Tambah Data RT" : "Update Data RT" ?></legend>

            <?php
            $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
            ?>

            <?php if ($model->isNewRecord): ?>

                <div class="form-group">
                    <label class="control-label col-sm-3">RW</label>
                    <div class="col-sm-6">
                        <?= Html::textInput('rw', $nama_rw, ['class' => 'form-control', 'disabled' => true]) ?>
                    </div>
                </div>

                <?= $form->field($model, 'nama_rt')->textInput(['maxlength' => true]) ?>

            <?php else: ?>

                <?php foreach ($field_warga as $warga): ?>

                    <?= $form->field($model, $warga)->widget(Select2::classname(), [
                        'data' => $list_warga_rt,
                        'language' => 'id',
                        'options' => ['placeholder' => '--PILIH--'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                <?php endforeach; ?>

                <div class="form-group">
                    <label class="control-label col-sm-3">Seksi</label>
                    <div class="col-sm-6">
                        <?= Html::button(' Edit', ['class' => 'fa fa-pencil btn btn-info btn-sm pull-right show-modal']) ?>
                        <table id="tbl_seksi" class="table table-bordered">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <?php
                Modal::begin([
                    'id' =>'modal_seksi',
                    'size' => 'modal-lg',
                    'header' => '<h2>Seksi - ' . $model->nama_rt . '/' . $nama_rw . '</h2>',
                ]);
                echo Yii::$app->controller->renderPartial('_modal_seksi', [
                    'model' => $model,
                    'nama_rw' => $nama_rw,
                    'list_warga_rt' => $list_warga_rt,
                    'list_seksi' => $list_seksi,
                ]);
                Modal::end();
                ?>
            
            <?php endif; ?>

            <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'path_logo')->fileInput(['accept' => 'image/x-png, image/jpg, image/jpeg']) ?>

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
        $.ajax({
            type: "POST",
            url: "' . \yii\helpers\Url::to(['ajax-select']) . '",
            data: {
                id: warga_existing,
                rt: ' . $model->id . '
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
        $("#modal_seksi").modal("show");
    });
    ',
    \yii\web\View::POS_READY,
    'form-rt-js'
);
?>