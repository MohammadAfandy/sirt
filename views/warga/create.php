<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Warga */

$this->title = 'Tambah Warga';
$this->params['breadcrumbs'][] = ['label' => 'Warga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
    	'step' => $step,
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
