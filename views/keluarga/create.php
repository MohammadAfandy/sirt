<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Keluarga */

$this->title = 'Create Keluarga';
$this->params['breadcrumbs'][] = ['label' => 'Keluargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
