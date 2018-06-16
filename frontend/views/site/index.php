<?php

use backend\models\Fish;
use common\models\UserPengguna;
use backend\models\UserKoperasi;
use backend\models\Kota;

$fish = Fish::find()->all();
$user = UserPengguna::find()->all();
$koperasi = UserKoperasi::find()->all();
$kota = Kota::find()->all();
/* @var $this yii\web\View */

$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";

$this->title = 'Koperasi Jualikan.id';
?>
<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="container">
						<div class="row align-items-center justify-content-center">
							<div class="banner-content col-lg-5 col-md-12">
								<h1 class="text-uppercase">
									Jadilah Kopeasi Ikan yang Maju<br>
								</h1>
								<p>
									Bergabunglah dengan jualikan.id dan bangun kopearsi ikanmu menjadi koperasi ikan terdepan
								</p>
								<button class="primary-btn2 mt-20 text-uppercase ">Daftar Disini<span class="lnr lnr-arrow-right"></span></button>
							</div>
							<div class="col-lg-7 d-flex align-self-end img-right">
								<img src="<?php echo $server ?>frontend/web/img/fisherman.png" style="width:112%; height:110%;">
							</div>
						</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start feature Area -->
			<section class="feature-area section-gap" id="service">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="single-feature d-flex flex-row pb-30">
								<div class="icon">
									<span class="lnr lnr-rocket"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">24/7 emergency</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
							<div class="single-feature d-flex flex-row pb-30">
								<div class="icon">
									<span class="lnr lnr-chart-bars"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">X-Ray Service</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
							<div class="single-feature d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-bug"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">Intensive Care</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="single-feature d-flex flex-row pb-30">
								<div class="icon">
									<span class="lnr lnr-heart-pulse"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">24/7 emergency</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
							<div class="single-feature d-flex flex-row pb-30">
								<div class="icon">
									<span class="lnr lnr-paw"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">X-Ray Service</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
							<div class="single-feature d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-users"></span>
								</div>
								<div class="desc">
									<h4 class="text-uppercase">Intensive Care</h4>
									<p>
										inappropriate behavior is often laughed off as “boys will be boys,” <br> women face higher conduct women face higher conduct.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End feature Area -->




			<!-- Start fact Area -->
			<section class="facts-area pt-100 pb-100" style="background-color: rgba(246, 255, 255, 1);">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 single-fact">
							<h2 class="counter"><?php echo count($user) ?></h2>
							<p class="text-uppercase">Pengguna</p>
						</div>
						<div class="col-lg-3 col-md-6 single-fact">
							<h2 class="counter"><?php echo count($koperasi) ?></h2>
							<p class="text-uppercase">Koperasi</p>
						</div>
						<div class="col-lg-3 col-md-6 single-fact">
							<h2 class="counter"><?php echo count($fish) ?></h2>
							<p class="text-uppercase">Ikan</p>
						</div>
						<div class="col-lg-3 col-md-6 single-fact">
							<h2 class="counter"><?php echo count($kota) ?></h2>
							<p class="text-uppercase">Kota</p>
						</div>
					</div>
				</div>
			</section>
			<!-- end fact Area -->
