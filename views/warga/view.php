<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Warga */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warga-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_warga',
            'no_ktp',
            'jenis_kelamin',
            'agama',
            'tempat_lahir',
            'tgl_lahir',
            'alamat:ntext',
            'no_hp',
            'email:email',
            'pekerjaan',
            'pendidikan',
            'status_kawin',
            'path_ktp:ntext',
            'id_kk',
            'id_jabatan',
            'created_date',
            'updated_date',
        ],
    ]) ?>

</div>
