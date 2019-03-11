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
    <?php
    // echo GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         [
    //             'attribute' => 'nama_rt',
    //             'value' => function($model) {
    //                 return Html::a($model->nama_rt, ['view', 'id' => $model->id]);
    //             },
    //             'format' => 'raw',
    //         ],
    //         [
    //             'attribute' => 'ketua',
    //             'value' => function($model) {
    //                 return Helpers::getNamaWarga($model->ketua);
    //             },
    //         ],
    //         [
    //             'attribute' => 'wakil',
    //             'value' => function($model) {
    //                 return Helpers::getNamaWarga($model->wakil);
    //             },
    //         ],
    //         [
    //             'attribute' => 'sekretaris',
    //             'value' => function($model) {
    //                 return Helpers::getNamaWarga($model->sekretaris);
    //             },
    //         ],
    //         [
    //             'attribute' => 'bendahara',
    //             'value' => function($model) {
    //                 return Helpers::getNamaWarga($model->bendahara);
    //             },
    //         ],
    //         [
    //             'class' => 'app\components\ActionColumn',
    //             'header' => 'Aksi',
    //             'template' => '{update} {delete}',
    //         ],
    //     ],
    // ]);
    ?>
    <?php if ($id): ?>        
        <center><h2>DAFTAR RT DI WILAYAH <?= $nama_rw ?></h2></center>
        <p>
            <?= Html::a('Tambah RT', ['create', 'rw' => $id], ['class' => 'btn btn-success']) ?>
        </p>
        <hr>
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>RT</th>
                    <th>Ketua RT</th>
                    <th>Wakil Ketua RT</th>
                    <th>Sekretaris RT</th>
                    <th>Bendahara RT</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data_rt)): ?>
                    <?php foreach ($data_rt as $key => $rt): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= Html::a($rt->nama_rt, ['view', 'id' => $rt->id]) ?></td>
                            <td><?= $rt->ketua ? Helpers::getNamaWarga($rt->ketua) : '-'?></td>
                            <td><?= $rt->wakil ? Helpers::getNamaWarga($rt->wakil) : '-'?></td>
                            <td><?= $rt->sekretaris ? Helpers::getNamaWarga($rt->sekretaris) : '-'?></td>
                            <td><?= $rt->bendahara ? Helpers::getNamaWarga($rt->bendahara) : '-'?></td>
                            <td>
                                <?= Html::a('Update',
                                    ['update', 'id' => $rt->id],
                                    [
                                        'class' => 'btn btn-primary btn-xs',
                                    ]
                                ); ?>
                                <?= Html::a('Delete',
                                    ['delete', 'id' => $rt->id],
                                    [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data-confirm' => 'Apakah Anda Yakin Ingin Menghapus Data ?',
                                        'data-method' => 'post',
                                    ]
                                ); ?>   
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif;?>
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