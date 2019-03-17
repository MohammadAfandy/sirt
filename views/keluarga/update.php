<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */

$this->title = 'Update Keluarga: ' . $model->no_kk;
$this->params['breadcrumbs'][] = ['label' => 'Keluargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_kk, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'list_warga' => $list_warga,
        'field_anggota' => $field_anggota,
    ]) ?>

</div>
