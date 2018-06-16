<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\UserKoperasi;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDriver */

$this->title = $model->driver_full_name;
// $this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->driver_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->driver_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Riwayat Saldo', ['saldo', 'id' => $model->driver_id], ['class' => 'btn btn-success']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'driver_id',
            // 'driver_image:ntext',
            [
                'attribute'=>'driver_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '../'. $data['driver_image'], ['width' => '200px','height' => '200px']);
                },
            ],
            'driver_full_name',
            'driver_phone',
            'driver_email:email',
            // 'driver_password',
            // 'driver_device_id',
            // 'driver_distribution_id',
            [
                'attribute'=>'driver_koperasi_id',
                'value' => function ($data){
                    $object  = UserKoperasi::find()->where(['koperasi_id' => $data['driver_koperasi_id']])->one();
                    return $object->koperasi_name;
                },
            ],
            'driver_vehicle_weight',
            'driver_address:ntext',
            'driver_saldo',
        ],
    ]) ?>

</div>
