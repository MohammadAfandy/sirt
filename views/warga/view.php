<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $model app\models\Warga */

$this->title = $model->nama_warga;
$this->params['breadcrumbs'][] = ['label' => 'Warga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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