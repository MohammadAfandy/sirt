<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Warga */

$this->title = 'Update Warga: ' . $model->nama_warga;
$this->params['breadcrumbs'][] = ['label' => 'Warga', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_warga, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'list_kk' => $list_kk,
        'list_rt' => $list_rt,
        'list_rw' => $list_rw,
    ]) ?>

</div>
