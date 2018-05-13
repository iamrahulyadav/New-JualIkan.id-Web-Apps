<?php

use backend\models\Fish;
use common\models\Order;
use common\models\Delivery;
use common\models\KoperasiPinjaman;
use common\models\KoperasiSimpanan;
use common\models\UserDriver;
use common\models\UserNelayan;
use backend\models\UserKoperasi;
/* @var $this yii\web\View */


$koperasi = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
$koperasiId = $koperasi->koperasi_id;

$month = Date("m");
$first = 1;
$last = Date("t");

$first_month = Date("Y-" . $month . "-" . $first . " H:i:s");
$last_month = Date("Y-". $month . "-" . $last . " H:i:s");

$order = Order::find()
          ->where(['order_koperasi_location_id' => $koperasiId])
          ->andWhere(['>', 'order_date', $first_month])
          ->andWhere(['<', 'order_date', $last_month])
          ->all();
$fish = Fish::find()->where(['fish_koperasi_id' => $koperasiId])->all();
$delivery = Delivery::find()->where(['delivery_order_koperasi_id' => $koperasiId])->all();
$nelayan = UserNelayan::find()->where(['nelayan_cooperative_id' => $koperasiId])->all();


$pinjaman = KoperasiPinjaman::find()->all();
$simpanan = KoperasiSimpanan::find()->all();
$driver = UserDriver::find()->all();

$this->title = 'Koperasi Jualikan.id';
?>

<script type="text/javascript" src="http://localhost/jualikan.id/backend/web/js/Chart.js"></script>
<script type="text/javascript" src="http://localhost/jualikan.id/backend/web/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="http://localhost/jualikan.id/backend/web/js/graph/order-and-delivery.js"></script>
<script type="text/javascript">
  displayDelivery(<?php echo $koperasiId; ?>);
</script>


<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php echo count($fish);?>
                    </h3>
                    <p>Stok Ikan Anda</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                <a href="http://localhost/papward/web/user-pengguna" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo count($order);?>
                    </h3>
                    <p>Order Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="fa   fa-truck"></i>
                </div>
                <a href="http://localhost/papward/web/bright" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php echo count($delivery);?>
                    </h3>
                    <p>Pengiriman Bulan ini</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="http://localhost/papward/web/spbu" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo count($driver)?>
                    </h3>
                    <p>Jumlah Driver Anda</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="http://localhost/papward/web/barang-bright" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
      <div class="col-lg-6 col-xs-12">
          <h3>Grafik jumlah order & pengiriman pada bulan ini</h3>
          <div class="row" style="margin:8px;">
              <canvas id="myChart" height="350"></canvas>
          </div>
      </div>
      <div class="col-lg-6 col-xs-12">
          <h3>Grafik hasil order & pengiriman pada bulan ini</h3>
          <div class="row" style="margin:8px;">
              <canvas id="myChart1" height="350"></canvas>
          </div>
      </div>
    </div>


    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php echo count($fish);?>
                    </h3>
                    <p>Stok Ikan Anda</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                <a href="http://localhost/papward/web/user-pengguna" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo count($order);?>
                    </h3>
                    <p>Order Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="fa   fa-truck"></i>
                </div>
                <a href="http://localhost/papward/web/bright" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?php echo count($driver);?>
                    </h3>
                    <p>Jumlah Driver Anda</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="http://localhost/papward/web/spbu" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo count($nelayan)?>
                    </h3>
                    <p>Jumlah Nelayan Anda</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="http://localhost/papward/web/barang-bright" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <h1>Dashboard</h1>

        <p class="lead">Tingkatkan kulitas koperaasimu, dengan bergabung pada Koperasi Jualikan.id.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    </div>
</div>
