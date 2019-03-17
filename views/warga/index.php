<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helpers;
use yii\helpers\ArrayHelper;
use app\models\Warga;
$this->title = 'Warga';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <h2 class="text-center">DATA WARGA</h2>
    <p>
        <?= Html::a('Tambah Warga', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php yii\widgets\Pjax::begin(['enablePushState' => false]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nama_warga',
                'value' => function($model) {
                    return Html::a($model->nama_warga, ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'no_ktp',
            [
                'attribute' => 'id_rt',
                'filter' => ArrayHelper::map(app\models\Rt::find()->asArray()->all(), 'id', 'nama_rt'),
                'value' => function($model) {
                    return $model->id_rt ? Helpers::getNamaRt($model->id_rt) : null;
                }
            ],
            [
                'attribute' => 'id_rw',
                'filter' => ArrayHelper::map(app\models\Rw::find()->asArray()->all(), 'id', 'nama_rw'),
                'value' => function($model) {
                    return $model->id_rw ? Helpers::getNamaRw($model->id_rw) : null;
                }
            ],
            [
                'attribute' => 'jenis_kelamin',
                'filter' => [1 => 'Laki - Laki', 2 => 'Perempuan'],
                'value' => function($model) {
                    return $model->jenis_kelamin === 1 ? 'Laki - Laki' : 'Perempuan';
                },
            ],
            [
                'attribute' => 'agama',
                'filter' => Warga::getAgama(),
            ],
            [
                'attribute' => 'pekerjaan',
                'filter' => Warga::getPekerjaan(),
            ],
            [
                'class' => 'app\components\ActionColumn',
                'header' => 'Aksi',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php yii\widgets\Pjax::end(); ?>
</div>
