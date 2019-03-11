<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\components\Helpers;
use app\models\Rt;
use kartik\select2\Select2;
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

            <div class="form-group">
                <label class="control-label col-sm-3">RW</label>
                <div class="col-sm-6">
                    <?= Html::textInput('rw', $nama_rw, ['class' => 'form-control', 'disabled' => true]) ?>
                </div>
            </div>

            <?php if ($model->isNewRecord): ?>

                <?= $form->field($model, 'nama_rt')->textInput(['maxlength' => true]) ?>

            <?php else: ?>

                <?= $form->field($model, 'ketua')->widget(Select2::classname(), [
                    'data' => $list_warga_rt,
                    'language' => 'id',
                    'options' => ['placeholder' => '--PILIH--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'wakil')->widget(Select2::classname(), [
                    'data' => $list_warga_rt,
                    'language' => 'id',
                    'options' => ['placeholder' => '--PILIH--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'sekretaris')->widget(Select2::classname(), [
                    'data' => $list_warga_rt,
                    'language' => 'id',
                    'options' => ['placeholder' => '--PILIH--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'bendahara')->widget(Select2::classname(), [
                    'data' => $list_warga_rt,
                    'language' => 'id',
                    'options' => ['placeholder' => '--PILIH--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

                <?= $form->field($model, 'awal_periode')->widget(\yii\jui\DatePicker::className(), [
                    'dateFormat' => 'yyyy-MM-dd',
                    'language' => 'id',
                    'options' => ['class' => 'form-control datepicker', 'readonly' => true],
                    'clientOptions' => [
                        'changeYear' => true,
                        'changeMonth' => true,
                        'yearRange' =>'2000:+10',
                    ],
                ]) ?>

                <?= $form->field($model, 'akhir_periode')->widget(\yii\jui\DatePicker::className(), [
                    'dateFormat' => 'yyyy-MM-dd',
                    'language' => 'id',
                    'options' => ['class' => 'form-control datepicker', 'readonly' => true],
                    'clientOptions' => [
                        'changeYear' => true,
                        'changeMonth' => true,
                        'yearRange' =>'2000:+10',
                    ],
                ]) ?>

            <?php endif; ?>

            <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'path_logo')->fileInput() ?>

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
    // $(".datepicker").css({"cursor": "pointer", "background": "#fff"});

    // $(document).on("change", "select2-hidden-accessible", function() {
    //     var data_warga = ' . json_encode($list_warga_rt) . ';

    //     var list_warga = "";
    //     for (warga in data_warga) {
    //         list_warga += `<option value="`+warga+`">`+data_warga[warga]+`</option>`;
    //     }


    //     $("select2-hidden-accessible:not(#this.id)").html("");
    // });

    // console.log(list_warga);
    ',
    \yii\web\View::POS_READY,
    'form-warga-js'
);
?>