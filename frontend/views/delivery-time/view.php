<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DeliveryTime */

$this->title = $model->delivery_time_name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-time-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->delivery_time_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->delivery_time_id], [
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
            'delivery_time_id',
            'delivery_time_name',
            'delivery_time_start',
            'delivery_time_end',
        ],
    ]) ?>

</div>
