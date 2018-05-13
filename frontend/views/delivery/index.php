<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deliveries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Delivery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'delivery_id',
            'delivery_code',
            'delivery_order_id:ntext',
            'delivery_order_koperasi_id',
            'delivery_driver_id',
            //'delivery_driver_track_id',
            //'delivery_time_depart',
            //'delivery_time_arrival',
            //'delivery_travel_time:datetime',
            //'delivery_travel_distance',
            //'delivery_payment',
            //'delivery_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
