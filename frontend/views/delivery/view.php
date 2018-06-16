<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\UserDriver;
use backend\models\UserKoperasi;

/* @var $this yii\web\View */
/* @var $model frontend\models\Delivery */

$this->title = "Pengriman ID-" . $model->delivery_code;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";
?>

<style>

#progressbar1 {
    width: 100%;
    background-color: #CACED2;
}
#progressbar {
    width: 10%;
    height: 30px;
    background-color: #3c8dbc;
}
h4 {
  font-size: 14px;
}
h3 {
  font-size: 24px;
}
</style>

<div class="delivery-view">
    <p>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->delivery_id], ['class' => 'btn btn-primary']) ?> -->
        <?= Html::a('Delete', ['delete', 'id' => $model->delivery_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <h3 id="titleprogressbar">Loading....</h3>
    <div id="progressbar1">
        <div id="progressbar"></div>
    </div>
    <h4 id="valueBar">0%</h4> 
    <div id="map_tracking" class="mapping" style="margin-bottom:20px;"></div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Kode Pengiriman',
                'attribute'=>'delivery_code',
                'value' => function ($data){
                    $berat = "Pengiriman ID-". $data['delivery_code'];
                    return $berat;
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'format' => 'html',
                'attribute'=>'delivery_order_id',
                'value' => function ($data){
                    $array = json_decode($data['delivery_order_id']);
                    $str = "";
                    for ($i=0; $i < count($array); $i++) {
                        $str = $str . "<p style='margin-bottom:0px;'>".
                        Html::a("Order JD-" . $array[$i], ['order/view', 'id' => $array[$i]], [
                            'class' => 'btn btn-primary'
                        ])
                         ."</p>";
                    }
                    return $str;
                },
                'headerOptions' => ['style' => 'width:110px;'],
            ],
            [
                'attribute'=>'delivery_order_koperasi_id',
                'value' => function ($data){
                    $model = UserKoperasi::find()->where(['koperasi_id' => $data['delivery_order_koperasi_id']])->one();
                    return $model['koperasi_name'];
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'format' => 'html',
                'attribute'=>'delivery_driver_id',
                'value' => function ($data){
                    $model = UserDriver::find()->where(['driver_id' => $data['delivery_driver_id']])->one();
                    return
                    Html::a($model['driver_full_name'], ['user-driver/view', 'id' => $model["driver_id"]]);
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            'delivery_time_depart:datetime',
            'delivery_time_arrival:datetime',
            [
                'attribute'=>'delivery_travel_time',
                'value' => function ($data){
                    if ($data['delivery_travel_time'] > 60 && $data['delivery_travel_time'] < 3559) {
                        return ((int)($data['delivery_travel_time']/60)). " Minutes";
                    }else if ($data['delivery_travel_time'] < 60){
                        return ((int)($data['delivery_travel_time']/60)). " Second";
                    }else {
                        return ((int)($data['delivery_travel_time']/3600)). " Hours";
                    }
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute'=>'delivery_travel_distance',
                'value' => function ($data){
                    if ($data['delivery_travel_distance'] > 1000) {
                        return ((int)($data['delivery_travel_distance']/1000)). " Kilometers";
                    }else {
                        return ((int)($data['delivery_travel_distance']/1000)). " Meters";
                    }
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            // 'delivery_travel_distance',
            [
                'attribute'=>'delivery_payment',
                'value' => function ($data){
                    return "Rp. " . (int) $data['delivery_payment'];
                }
                // 'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute' => 'delivery_status',
                'format' => 'html',
                'label' => 'Status Pengiriman',
                'value' => function ($data){
                    if ($data['delivery_status'] == 0){
                        return "<p style='color:orange;'>Belum di Proses</p><p>";
                    }
                    elseif ($data['delivery_status'] == 1){
                        return "<p style='color:#337ab7;'>Dalam Proses Pengriman</p>";
                    }
                    elseif ($data['delivery_status'] == 2){
                        return "<p style='color:green;'>Pengiriman Selesai</p>";
                    }
                    elseif ($data['delivery_status'] == 3){
                        return "<p style='color:red;'>Pengiriman Gagal</p>";
                    }
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih Status',
                ],
                'filter'=>array( 0 =>"Belum di Proses", 1 =>"Dalam Proses Pengiriman", 2 =>"Pengriman Selesai", 3 =>"Pengriman Gagal"),
                'headerOptions' => ['style' => 'width:200px'],
            ],
        ],
    ]) ?>
  
    <canvas id="carcanvas"  width="1" height="1"></canvas>
    <script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
    <script>
        // TODO: Replace with your project's customized code snippet
        var config = {
          apiKey: "AIzaSyBQ3kToZHUYfdOGbl7x-m_v54CO701eKk8",
          authDomain: "jualikan-1515261954213.firebaseapp.com",
          databaseURL: "https://jualikan-1515261954213.firebaseio.com",
          projectId: "jualikan-1515261954213",
          storageBucket: "jualikan-1515261954213.appspot.com",
          messagingSenderId: "724156806372"
        };
        firebase.initializeApp(config);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo $server?>backend/web/js/vrp/trackRealTimeFront.js" ></script>
    <script type="text/javascript">
      getDelivery("<?php echo $model->delivery_id ?>");
    </script>

</div>
