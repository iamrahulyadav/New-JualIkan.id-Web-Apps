<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */

$this->title = $model->driver_id;
$this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->driver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->driver_id], [
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
            'driver_id',
            'driver_full_name',
            'driver_phone',
            'driver_email:email',
            'driver_password',
            'driver_device_id',
            'driver_image:ntext',
            'driver_koperasi_id',
            'driver_vehicle_weight',
            'driver_address:ntext',
            'driver_track_id',
            'driver_saldo',
            'driver_status',
        ],
    ]) ?>

</div>
