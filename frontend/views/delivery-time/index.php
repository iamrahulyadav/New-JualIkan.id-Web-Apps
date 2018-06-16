<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DeliveryTImeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Waktu Pengriman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-time-index">

    <p>
        <?= Html::a('Tambah Waktu Pengriman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'delivery_time_id',
//             'delivery_time_koperasi_id:datetime',
            'delivery_time_name',
            'delivery_time_start',
            'delivery_time_end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
