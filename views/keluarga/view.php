<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */

$this->title = $model->no_kk;
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="keluarga-view">
    <div class="box-header with-border">
        <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
    </div>
    <div class="box-body">

        <?= Html::a('Kembali', Yii::$app->request->referrer ? Yii::$app->request->referrer : ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'no_kk',
                [
                    'attribute' => 'kepala_keluarga',
                    'value' => function($model) {
                        return Helpers::getNamaWarga($model->kepala_keluarga);
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
