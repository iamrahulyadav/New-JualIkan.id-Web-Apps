<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Kota;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserPenggunaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar User Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-pengguna-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $obeject = Kota::find()->all();
        $objectArray = ArrayHelper::map($obeject, 'kota_id', 'kota_name');
    ?>

    <p>
        <?= Html::a('Tambah User Pengguna', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'user_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '../'. $data['user_image'], ['width' => '60px','height' => '60px']);
                },
                'headerOptions' => ['style' => 'width:100px;'],
            ],
            'user_full_name',
            // 'user_phone',
            // 'user_email:email',
            //'user_password',
            //'user_device_id',
            [
                'attribute'=>'user_kota_id',
                'value' => function ($data){
                    $object  = Kota::find()->where(['kota_id' => $data['user_kota_id']])->one();
                    return $object->kota_name;
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih kota',
                ],
                'filter'=>$objectArray,
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            // 'user_kota_id',
            // 'user_address',
            [
                'attribute'=>'user_saldo',
                'format' => 'html',
                'value' => function ($data){
                    return "Rp. " . $data['user_saldo'];
                },
            ],
            [
                'attribute' => 'user_saldo',
                'format' => 'html',
                'label' => 'Top-up',
                'value' => function ($data){
                    // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                    return Html::a("Top-up", ['top-up', 'id' => $data['user_id']], [
                        'class'=>'btn btn-success btn-sm'
                    ]);
                },
                'headerOptions' => ['style' => 'width:80px;'],
            ],
            [
                'attribute' => 'user_saldo',
                'format' => 'html',
                'label' => 'Riwayat Saldo',
                'value' => function ($data){
                    // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                    return Html::a("Riwayat Saldo", ['saldo', 'id' => $data['user_id']], [
                        'class'=>'btn btn-success btn-sm'
                    ]);
                },
                'headerOptions' => ['style' => 'width:80px;'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
