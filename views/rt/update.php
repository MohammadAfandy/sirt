<?php

use yii\helpers\Html;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $model app\models\Rt */

$nama_rw = Helpers::getNamaRw($model->id_rw);

$this->title = 'Update RT: ' . $model->nama_rt;
$this->params['breadcrumbs'][] = ['label' => 'RT', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $nama_rw, 'url' => ['index', 'id' => $model->id_rw]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'list_warga_rt' => $list_warga_rt,
        'nama_rw' => $nama_rw,
    ]) ?>

</div>
