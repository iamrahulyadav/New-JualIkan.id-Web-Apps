<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Delivery */

$this->title = $model->delivery_id;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->delivery_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->delivery_id], [
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
            'delivery_id',
            'delivery_code',
            'delivery_order_id:ntext',
            'delivery_order_koperasi_id',
            'delivery_driver_id',
            'delivery_driver_track_id',
            'delivery_time_depart',
            'delivery_time_arrival',
            'delivery_travel_time:datetime',
            'delivery_travel_distance',
            'delivery_payment',
            'delivery_status',
        ],
    ]) ?>

</div>
