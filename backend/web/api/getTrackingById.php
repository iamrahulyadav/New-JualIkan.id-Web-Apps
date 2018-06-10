<?php
  include 'connect.php';
  $deliveryID = $_GET['id'];
  $resultFinal = array();

  date_default_timezone_set('Asia/Jakarta');
  $date = date('y-m-d');

  $sql = "SELECT user_koperasi.*, user_driver.*, delivery.*
          FROM delivery as delivery, user_driver as user_driver, user_koperasi as user_koperasi
          WHERE user_koperasi.koperasi_id = delivery.delivery_order_koperasi_id
                and user_driver.driver_id = delivery.delivery_driver_id
                and delivery.delivery_id = $deliveryID
                and delivery.delivery_status = 1";

  $deliveryResult = $connect->query($sql);
  $delivery = $deliveryResult->fetch_assoc();

  $resultFinal["order"] = $resultLocation;
  $resultFinal["driver"] = $resultDriver;
  $resultFinal["koperasi"] = $koperasi;

  echo json_encode($resultFinal, JSON_PRETTY_PRINT);

  function order($id){
      include 'connect.php';
      $sql = "SELECT `order`.*, user_pengguna.*
              FROM `order` as `order`, user_pengguna as user_pengguna
              WHERE user_pengguna.user_id = `order`.order_user_id
                    and `order`.order_id = $id";
      $orderResult = $connect->query($sql);
      $order = $orderResult->fetch_assoc();

      $result['id'] = $order['order_id'];
      $result['name'] = $order['user_full_name'];
      $result['address'] = $order['order_location_adress'];
      $result['lat'] = $order['order_location_lat'];
      $result['lng'] = $order['order_location_lng'];

      return $result;
  }

  function koperasi($obj){
      $result['id'] = $
  }
 ?>
