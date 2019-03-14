<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Helpers;

$nama_rw = Helpers::getNamaRw($id);

$this->title = 'RT';
$id ? $this->params['breadcrumbs'][] = ['label' => 'RT', 'url' => ['index']] : null;
$this->params['breadcrumbs'][] = $id ? ['label' => $nama_rw, 'url' => ['index', 'id' => $id]] : $this->title;
?>

<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <div class="row">
        <div class="col-sm-2">
            <label>PILIH RW</label>
        </div>
        <div class="col-sm-4">
            <?= Html::dropDownList('rw', $id, \yii\helpers\ArrayHelper::map($list_rw, 'id', 'nama_rw'), ['prompt' => '--PILIH--', 'class' => 'form-control', 'id' => 'pilih_rw']) ?>
        </div>
    </div>
    <hr>
    <?php if ($id): ?>        
        <center><h2>DAFTAR RT DI WILAYAH <?= $nama_rw ?></h2></center>
        <p>
            <?= Html::a('Tambah RT', ['create', 'rw' => $id], ['class' => 'btn btn-success']) ?>
        </p>
        <hr>
        <?php Pjax::begin(['enablePushState' => false]) ?>
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                [
                    'attribute' => 'nama_rt',
                    'value' => function($model) {
                        return Html::a($model->nama_rt, ['view', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'ketua',
                    // 'enableSorting' => false,
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->ketua);
                    },
                ],
                [
                    'attribute' => 'wakil',
                    // 'enableSorting' => false,
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->wakil);
                    },
                ],
                [
                    'attribute' => 'sekretaris',
                    // 'enableSorting' => false,
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->sekretaris);
                    },
                ],
                [
                    'attribute' => 'bendahara',
                    // 'enableSorting' => false,
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->bendahara);
                    },
                ],
                [
                    'class' => 'app\components\ActionColumn',
                    'header' => 'Aksi',
                    'template' => '{update} {delete}',
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    <?php endif; ?>
</div>

<?php
$this->registerJs(
    '
    $("#pilih_rw").on("change", function() {
        showLoading();
        window.location.href = "' . \yii\helpers\Url::to(['index']) . '/" + this.value;
    });
    ',
    \yii\web\View::POS_READY,
    'alternatif-js'
);
?>