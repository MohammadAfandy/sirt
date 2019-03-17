<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */

$this->title = 'Tambah Keluarga';
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
