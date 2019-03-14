<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keluarga-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_kk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kepala_keluarga')->textInput() ?>

    <?= $form->field($model, 'anggota_keluarga')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'path_kk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
