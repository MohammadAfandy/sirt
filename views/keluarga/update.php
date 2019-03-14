<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */

$this->title = 'Update Keluarga: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Keluargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keluarga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
