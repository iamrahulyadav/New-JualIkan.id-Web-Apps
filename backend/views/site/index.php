<?php

use backend\models\Fish;
use common\models\Order;
use common\models\Delivery;
use common\models\KoperasiPinjaman;
use common\models\KoperasiSimpanan;
use common\models\UserDriver;
use common\models\UserPengguna;
use common\models\UserNelayan;
use common\models\FishReview;
use backend\models\Articel;
use backend\models\UserKoperasi;
/* @var $this yii\web\View */

$server = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";

$month = Date("m");
$first = 1;
$last = Date("t");

$first_month = Date("Y-" . $month . "-" . $first . " H:i:s");
$last_month = Date("Y-". $month . "-" . $last . " H:i:s");

$user = UserPengguna::find()->all();
$koperasi = UserKoperasi::find()->all();
$artikel = Articel::find()->all();

$order = Order::find()->all();
$fish = Fish::find()->all();
$delivery = Delivery::find()->all();
$nelayan = UserNelayan::find()->all();

$driver = UserDriver::find()->all();

$pinjaman = KoperasiPinjaman::find()->all();
$simpanan = KoperasiSimpanan::find()->all();

$FishReview = FishReview::find()->all();

$totPinjaman = 0;
$totSimpanan = 0;
$totReview = 0;

for($i = 0; $i < count($FishReview); $i++){
    $totReview = $totReview + $FishReview[$i]['review_jumalh'];
}

if (count($FishReview) == 0) {
    $review = 0;
}else {
    $review = $totReview/(count($FishReview));
}

for($i = 0; $i < count($pinjaman); $i++){
    $totPinjaman = $totPinjaman + $pinjaman[$i]['pinjaman_jumlah'];
}

for($i = 0; $i < count($simpanan); $i++){
    $totSimpanan = $totSimpanan + $simpanan[$i]['simpanan_jumlah'];
}

$this->title = 'Admin Jualikan.id';
?>

<script type="text/javascript" src="<?php echo $server ?>backend/web/js/Chart.js"></script>
<script type="text/javascript" src="<?php echo $server ?>backend/web/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $server ?>backend/web/js/graph/order-and-delivery.js"></script>
<script type="text/javascript">
  displayDeliveryAll();
</script>


<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php echo count($user);?>
                    </h3>
                    <p>Daftar User Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $server ?>admin/user-pengguna/index" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo count($koperasi);?>
                    </h3>
                    <p>Datar User Koperasi</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $server ?>admin/user-koperasi/index" class="small-box-footer">More info
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
                    <p>Daftar User Driver</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $server ?>admin/user-driver/index" class="small-box-footer">More info
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
                    <p>Daftar User Nelayan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $server ?>admin/user-nelayan/index" class="small-box-footer">More info
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
                    <h3 style="font-size:32px;">
                        <?php echo count($fish) ?>
                    </h3>
                    <p>Jumlah Stok Ikan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                <a href="<?php echo $server ?>admin/fish/index" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 style="font-size:32px;">
                        <?php echo count($delivery) ?>
                    </h3>
                    <p>Jumlah Pengriman</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="<?php echo $server ?>admin/delivery/index" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 style="font-size:32px;">
                        <?php echo count($order)?>
                    </h3>
                    <p>Jumlah Order</p>
                </div>
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <a href="<?php echo $server ?>admin/order/index" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>

        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 style="font-size:32px;">
                        <?php echo count($artikel);?>
                    </h3>
                    <p>Jumlah Artikel Bantuan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sticky-note"></i>
                </div>
                <a href="<?php echo $server ?>admin/articel/index" class="small-box-footer">More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!--
    <div class="jumbotron">
        <h1>Dashboard</h1>
        <p class="lead">Tingkatkan kulitas koperaasimu, dengan bergabung pada Koperasi Jualikan.id.</p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    </div>
</div>
