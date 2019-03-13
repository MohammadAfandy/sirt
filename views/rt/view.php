<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\components\Helpers;

$nama_rw = Helpers::getNamaRw($model->id_rw);
$this->title = $model->nama_rt;
$this->params['breadcrumbs'][] = ['label' => 'RT', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $nama_rw, 'url' => ['index', 'id' => $model->id_rw]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <div class="col-sm">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nama_rt',
                [
                    'attribute' => 'id_rw',
                    'value' => function($model) {
                        return Helpers::getNamaRw($model->id_rw);
                    },
                ],
                [
                    'attribute' => 'ketua',
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->ketua);
                    },
                ],
                [
                    'attribute' => 'wakil',
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->wakil);
                    },
                ],
                [
                    'attribute' => 'sekretaris',
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->sekretaris);
                    },
                ],
                [
                    'attribute' => 'bendahara',
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->bendahara);
                    },
                ],
                'alamat',
                'awal_periode',
                'akhir_periode',
            ],
        ]) ?>
    </div>

    <div class="col-sm pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
