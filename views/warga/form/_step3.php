<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helpers;

?>
<div class="box-header with-border">
    <h3 class="box-title">Preview</h3>
</div>
<div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_warga',
            'no_ktp',
            [
                'attribute' => 'path_ktp',
                'value' => function($model) {
                    return $model->path_ktp ? Html::button('Lihat', ['data-img-url' => $model->path_ktp, 'class' => 'btn btn-success btn-xs show-modal']) : '<span class="not-set">(Belum Upload KTP)</span>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'jenis_kelamin',
                'value' => function($model) {
                    return Helpers::getJenisKelamin($model->jenis_kelamin);
                }
            ],
            'agama',
            'tempat_lahir',
            [
                'attribute' => 'tgl_lahir',
                'value' => function($model) {
                    return Helpers::dateIndonesia($model->tgl_lahir);
                }
            ],
            'alamat:ntext',
            [
                'attribute' => 'id_rt',
                'value' => function($model) {
                    return $model->id_rt ? Helpers::getNamaRt($model->id_rt) : null;
                }
            ],
            [
                'attribute' => 'id_rw',
                'value' => function($model) {
                    return $model->id_rw ? Helpers::getNamaRw($model->id_rw) : null;
                }
            ],
            'no_hp',
            'email:email',
            'pekerjaan',
            'pendidikan',
            'status_kawin',
        ],
    ]) ?>
</div>

<div class="form-group">
    <div class="col-sm-5 pull-right">
        <?= Html::a('Sebelumnya', ['create', 'step' => 2, 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>
</div>