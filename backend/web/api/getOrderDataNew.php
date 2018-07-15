<?php
  include 'connect.php';
  $id = $_GET['id'];
  $resultFinal = array();

  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d');
//   $time_min = date('H:m:s');
  $time_min = "20:00:00";
  $time_max = "24:00:00";
  
//   ambil time windows yang paling dekat waktu sekarang
  $sqlTime = "SELECT * FROM delivery_time WHERE delivery_time_start between '$time_min' and '$time_max' ORDER BY delivery_time_start ASC LIMIT 1";
  $queryTime = $connect->query($sqlTime);
  $rowTime = $queryTime->fetch_assoc();
  $timeId = $rowTime['delivery_time_id'];

//   $sql = "SELECT delivery_time.*, `order`.*, user_pengguna.* FROM `order` as `order`, delivery_time as delivery_time, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and `order`.order_delivery_time_id and delivery_time.delivery_time_start between '$time_min' and '$time_max'";
  $sql = "SELECT `order`.*, user_pengguna.* FROM `order` as `order`, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and `order`.order_delivery_time_id = $timeId and `order`.order_date like '%$date%' and `order`.order_status = 1";
  $queryResult = $connect->query($sql);
  $resultLocation = array();

  checkOrder($id);

  $sql1 = "SELECT user_driver.*
            FROM user_driver as user_driver
            WHERE user_driver.driver_koperasi_id = '$id' and user_driver.driver_device_id != '' and user_driver.driver_status = 1";
  $queryResult1 = $connect->query($sql1);
  $resultDriver = array();

  $sql2 = "SELECT * FROM user_koperasi WHERE koperasi_id = '$id'";
  $queryResult2 = $connect->query($sql2);
  $koperasi = $queryResult2->fetch_assoc();
  
  while($fetchData = $queryResult->fetch_assoc()){
    $marker = array();
    //
    $marker[] = floatval($fetchData['order_location_lat']);
    $marker[] = floatval($fetchData['order_location_lng']);
    
    $delivery_time['id'] = (int)$rowTime['delivery_time_id'];
    $delivery_time['start'] = $rowTime['delivery_time_start'];
    $delivery_time['end'] = $rowTime['delivery_time_end'];

    $dialog = array();
    $dialog['id'] = (int)$fetchData['order_id'];
    $dialog['image'] = "http://ishom.jagopesan.com/jualikan.id/".$fetchData['user_image'];
    $dialog['username'] = $fetchData['user_full_name'];
    $dialog['address'] = $fetchData['order_location_adress'];
    $dialog['weight'] = (int) $fetchData['order_weight'];
    $dialog['delivery_time'] = $delivery_time;
    $dialog['price'] = (int) $fetchData['order_payment_total'];
    $dialog['lat'] = (double) $fetchData['order_location_lat'];
    $dialog['lng'] = (double) $fetchData['order_location_lng'];

    $resultLocation[] = [
        "marker" => $marker,
        "information" => $dialog,
    ];
  }
  while($fetchData1 = $queryResult1->fetch_assoc()){
    $dialog1 = array();
    
    $dialog1['id'] = (int)$fetchData1['driver_id'];
    $dialog1['image'] = "http://ishom.jagopesan.com/jualikan.id/".$fetchData1['driver_image'];
    $dialog1['username'] = $fetchData1['driver_full_name'];
    $dialog1['address'] = $fetchData1['driver_address'];
    $dialog1['device_id'] = $fetchData1['driver_device_id'];
    $dialog1['weight'] = (int) $fetchData1['driver_vehicle_weight'];

    $resultDriver[] = $dialog1;
  }

  $resultFinal["order"] = $resultLocation;
  $resultFinal["driver"] = $resultDriver;
  $resultFinal["koperasi"] = $koperasi;

  echo json_encode($resultFinal, JSON_PRETTY_PRINT);
  // echo json_encode($result);

  function checkOrder($id){
      include 'connect.php';
    
      date_default_timezone_set('Asia/Jakarta');
      $date = date('Y-m-d');
      $time_max = date('H:m:s');
      $time_min = "00:00:00";  
      
      $sql = "SELECT delivery_time.*, `order`.*, user_pengguna.* FROM `order` as `order`, delivery_time as delivery_time, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and delivery_time.delivery_time_id = `order`.order_delivery_time_id and `order`.order_date like '%$date%' and delivery_time.delivery_time_id = `order`.order_delivery_time_id and delivery_time.delivery_time_start between '$time_min' and '$time_max' and `order`.order_status = 0";
      $queryResult = $connect->query($sql);
      while($result = $queryResult->fetch_assoc()){
           setexpired($result['order_id']);
      }
  }

  function setexpired($id){
      include 'connect.php';
      $sql = "UPDATE `order` SET order_status = '5' WHERE order_id = '$id'";
      $connect->query($sql);
  }
 ?>
