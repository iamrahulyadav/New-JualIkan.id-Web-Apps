<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use frontend\models\UserKoperasi;
use common\models\UserPengguna;
use common\models\Order;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Pesanan';
$this->params['breadcrumbs'][] = $this->title;

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
      $this->registerJsFile('@yii/assets/yii.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>

    <?php
        $Object = UserKoperasi::find()->all();
        $objectArray = ArrayHelper::map($Object, 'koperasi_id', 'koperasi_name');

        $Object1 = UserPengguna::find()->all();
        $objectArray1 = ArrayHelper::map($Object1, 'user_id', 'user_full_name');

        $object2 = Order::find()->where(['order_status' => 1])->all();
    ?>

    <div id="map_canvas" class="mapping" style="margin-bottom:20px;"></div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            // 'order_id',
            // 'order_cart_id:ntext',
            [
                'attribute'=>'order_user_id',
                'value' => function ($data){
                    $object  = UserPengguna::find()->where(['user_id' => $data['order_user_id']])->one();
                    return $object->user_full_name;
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih User',
                ],
                'filter'=> $objectArray1,
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute'=>'order_date',
                'value' => function ($data){
                    Yii::$app->formatter->locale = 'en-US';
                    // echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1. Januar 2014
                    return Yii::$app->formatter->asDate($data['order_date']);
                },
                'filterType'=> \kartik\grid\GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'options' => ['placeholder' => 'Pilih Tanggal'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose'=>true,

                    ],
                    'removeButton' => false,
                    // 'pickerButton' => false,
                ],
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute'=>'order_weight',
                'value' => function ($data){
                    $berat = $data['order_weight'].  " Kg";
                    return $berat;
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],

            [
                'attribute'=>'order_payment_total',
                'value' => function ($data){
                    $berat = "Rp. " . $data['order_payment_total'];
                    return $berat;
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute' => 'order_status',
                'format' => 'html',
                'label' => 'Status Order',
                'value' => function ($data){
                    if ($data['order_status'] == 0){
                        return "<p style='color:orange;'>Belum Melakukan Pembayaran</p>";
                    }
                    elseif ($data['order_status'] == 1){
                        return "<p style='color:#337ab7;'>Sudah Melakukan Pembayaran</p>";
                    }
                    elseif ($data['order_status'] == 2){
                        return "<p style='color:#337ab7;'>Dalam Proses Pengiriman</p>";
                    }
                    elseif ($data['order_status'] == 3){
                        return "<p style='color:green;'>Pengiriman Selesai</p>";
                    }
                    elseif ($data['order_status'] == 5){
                        return "<p style='color:red;'>Expired</p>";
                    }
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Status',
                ],
                'filter'=>array( 0 =>"Belum Melakukan Pembayaran", 1 =>"Sudah Melakukan Pembayaran", 2 =>"Dalam Proses Pengiriman", 3 =>"Pengiriman Selesai", 5 =>"Expired"),
            ],
            // 'order_location_adress:ntext',
            // 'order_location_lat',
            //'order_location_lng',
            //'order_driver_id',
            //'order_drive_track_id',
            //'order_koperasi_location_id',
            //'order_delivery_time:datetime',
            //'order_delivery_distance',
            //'order_delivery_payment',
            //'order_delivery_payment_url:ntext',
            //'order_weight',
            //'order_date',
            //'order_payment_type_id',
            //'order_payment_total',
            //'order_delivery_time_id:datetime',
            //'order_status',
            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                    'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    },
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'View')
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'delete') {
                        $url = Url::to(['order/delete', 'id' => $model->order_id]);
                        return $url;
                    }
                    if ($action === 'view') {
                        $url = Url::to(['order/view', 'id' => $model->order_id]);
                        return $url;
                    }
                }
            ],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $server?>backend/web/js/setMaps.js" ></script>
    <script type="text/javascript">
      getOrderBulanIniAll();
    </script>

</div>
