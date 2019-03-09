<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helpers;
use app\models\Warga;
$this->title = 'Warga';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <p>
        <?= Html::a('Tambah Warga', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_warga',
            'no_ktp',
            'no_kk',
            'id_rt',
            'id_rw',
            [
                'attribute' => 'jenis_kelamin',
                'filter' => [1 => 'Laki - Laki', 2 => 'Perempuan'],
                'value' => function ($model) {
                    return $model->jenis_kelamin === 1 ? 'Laki - Laki' : 'Perempuan';
                },
            ],
            [
                'attribute' => 'agama',
                'filter' => Warga::$agama,
            ],
            [
                'attribute' => 'pekerjaan',
                'filter' => Warga::$pekerjaan,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
