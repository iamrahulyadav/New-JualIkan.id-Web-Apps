<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KoperasiSimpanan */

$this->title = $model->simpanan_id;
$this->params['breadcrumbs'][] = ['label' => 'Koperasi Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="koperasi-simpanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->simpanan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->simpanan_id], [
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
            'simpanan_id',
            'simpanan_koperasi_id',
            'simpanan_date',
            'simpanan_nelayan_id',
            'simpanan_desc:ntext',
            'simpanan_jumlah',
        ],
    ]) ?>

</div>
