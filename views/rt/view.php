<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\components\Helpers;
use kongoon\orgchart\OrgChart;

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
    <div id="org-tree">
        <?php

        $data_seksi = [];
        $seksi = $model->seksi ? json_decode($model->seksi, true) : null;
        if ($seksi) {
            $i = 0;
            foreach ($seksi as $nama_seksi => $nama_warga) {
                $data_seksi[$i][0]['v'] = $nama_seksi;
                $data_seksi[$i][0]['f'] = '<strong>'.$nama_seksi.'</strong><br>'.Helpers::getNamaWarga($nama_warga);
                $data_seksi[$i][] = 'seksi'; 
                $data_seksi[$i][] = $nama_seksi;
                $i++;
            }
        }

        $data = [
            [
                ['v' => 'ketua', 'f' => 'Ketua RT<br>' . Helpers::getNamaWarga($model->ketua)],
                '',
                'ketua'
            ],
            [
                ['v' => 'wakil', 'f' => 'Wakil Ketua RT<br>' . Helpers::getNamaWarga($model->wakil)],
                'ketua',
                'wakil'
            ],
            [
                ['v' => 'sekretaris', 'f' => 'Sekretaris<br>' . Helpers::getNamaWarga($model->sekretaris)],
                'wakil',
                'sekretaris'
            ],
            [
                ['v' => 'seksi', 'f' => 'Seksi'],
                'wakil',
                'seksi'
            ],
            [
                ['v' => 'bendahara', 'f' => 'Bendahara<br>' . Helpers::getNamaWarga($model->bendahara)],
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