<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Helpers;

$this->title = 'Keluarga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <h2 class="text-center">DATA KELUARGA</h2>
    <p>
        <?= Html::a('Tambah Keluarga', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php Pjax::begin(['enablePushState' => false]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_kk',
            'kepala_keluarga',

            [
                'class' => 'app\components\ActionColumn',
                'header' => 'Aksi',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
