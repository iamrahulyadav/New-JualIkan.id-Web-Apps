<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserDriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar User Driver';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $Object = UserKoperasi::find()->all();
        $objectArray = ArrayHelper::map($Object, 'koperasi_id', 'koperasi_name');
    ?>

    <p>
        <?= Html::a('Create User Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'driver_id',
            // 'driver_image:ntext',
            [
                'attribute'=>'driver_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '../'. $data['driver_image'], ['width' => '60px','height' => '60px']);
                },
                'headerOptions' => ['style' => 'width:70px;'],
            ],
            'driver_full_name',
            // 'driver_phone',
            // 'driver_email:email',
            // 'driver_password',
            //'driver_device_id',
            [
                'attribute'=>'driver_koperasi_id',
                'value' => function ($data){
                    $object  = UserKoperasi::find()->where(['koperasi_id' => $data['driver_koperasi_id']])->one();
                    return $object->koperasi_name;
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Lokasi Distribusi',
                ],
                'filter'=> $objectArray,
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            'driver_vehicle_weight',
            //'driver_address:ntext',
            'driver_saldo',
            [
                'format' => 'html',
                'label' => '',
                'value' => function ($data){
                    // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                    return Html::a("Top-up", ['top-up', 'id' => $data['driver_id']], [
                        'class'=>'btn btn-success btn-sm'
                    ]);
                }
            ],
            [
                'format' => 'html',
                'label' => '',
                'value' => function ($data){
                    // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                    return Html::a("Berat Maks", ['vehicle', 'id' => $data['driver_id']], [
                        'class'=>'btn btn-primary btn-sm'
                    ]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
