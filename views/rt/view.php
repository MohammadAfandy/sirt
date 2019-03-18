<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\components\Helpers;
use kongoon\orgchart\OrgChart;
use yii\bootstrap\Modal;

$nama_rw = Helpers::getNamaRw($model->id_rw);
$this->title = $model->nama_rt;
$this->params['breadcrumbs'][] = ['label' => 'RT', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $nama_rw, 'url' => ['index', 'rw' => $model->id_rw]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
.google-visualization-orgchart-table {
    border-collapse: separate;
}
</style>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
    <?php
    Modal::begin(['id' =>'modal_foto', 'size' => 'modal-md']);
    echo '<img src="" class="foto">';
    Modal::end();
    ?>
    <div id="org-tree" style="display: block; margin: 0 auto 50px auto;">
        <h3 class="text-center">STRUKTUR ORGANISASI <?= $model->nama_rt ?> / <?= $nama_rw ?></h3>
        <?php
        $data_seksi = [];
        $seksi = $model->seksi ? json_decode($model->seksi, true) : null;
        if ($seksi) {
            $i = 0;
            foreach ($seksi as $nama_seksi => $nama_warga) {
                $nama = array_map(function($val) { return Helpers::getNamaWarga($val); }, $nama_warga);
                $data_seksi[$i][0]['v'] = $nama_seksi;
                $data_seksi[$i][0]['f'] = '<strong>' . strtoupper($list_seksi[$nama_seksi]) . '</strong><hr>' . implode('<br><br>', $nama);
                $data_seksi[$i][] = 'seksi'; 
                $data_seksi[$i][] = $nama_seksi;
                $i++;
            }
        }

        $data = [
            [
                ['v' => 'ketua', 'f' => '<strong>KETUA RT</strong><hr>' . Helpers::getNamaWarga($model->ketua)],
                '',
                'ketua'
            ],
            [
                ['v' => 'wakil', 'f' => '<strong>WAKIL KETUA RT</strong><hr>' . Helpers::getNamaWarga($model->wakil)],
                'ketua',
                'wakil'
            ],
            [
                ['v' => 'sekretaris', 'f' => '<strong>SEKRETARIS</strong><hr>' . Helpers::getNamaWarga($model->sekretaris)],
                'wakil',
                'sekretaris'
            ],
            [
                ['v' => 'seksi', 'f' => '<strong>SEKSI</strong>'],
                'wakil',
                'seksi'
            ],
            [
                ['v' => 'bendahara', 'f' => '<strong>BENDAHARA</strong><hr>' . Helpers::getNamaWarga($model->bendahara)],
                'wakil',
                'bendahara'
            ],

        ];
        $data = array_merge($data, $data_seksi);
        echo OrgChart::widget([
            'data' => $data,
        ]);
        ?>
    </div>
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
                    'attribute' => 'path_logo',
                    'value' => function($model) {
                        return $model->path_logo ? Html::button('Lihat', ['data-img-url' => $model->path_logo, 'class' => 'btn btn-success btn-xs show-modal']) : '<span class="not-set">(Belum Upload Logo)</span>';
                    },
                    'format' => 'raw',
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
                // 'awal_periode',
                // 'akhir_periode',
            ],
        ]) ?>
    </div>
</div>

<?php
$this->registerJs(
    '
    $(document).on("click", ".show-modal", function(e) {
        e.preventDefault();
        $("#modal_foto").modal("show").find(".foto").attr("src", "/" + $(this).attr("data-img-url"));
    });
    ',
    \yii\web\View::POS_READY,
    'kriteria-js'
);
?>