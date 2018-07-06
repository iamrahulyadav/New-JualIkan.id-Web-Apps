<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */

$this->title = "Koperasi Simpan ID-" . $model->simpanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->simpanan_id, 'url' => ['view', 'id' => $model->simpanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="koperasi-simpanan-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
