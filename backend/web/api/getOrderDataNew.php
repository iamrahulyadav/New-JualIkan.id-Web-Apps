<?php
  include 'connect.php';
  $id = $_GET['id'];
  $resultFinal = array();

  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d');
  
  $sql = "SELECT `order`.*, user_pengguna.* FROM `order` as `order`, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and `order`.order_date like '%$date%' and `order`.order_status = 1";
  $queryResult = $connect->query($sql);
  $resultLocation = array();

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

    $dialog = array();
    $dialog['id'] = (int)$fetchData['order_id'];
    $dialog['image'] = "http://ishom.jagopesan.com/jualikan.id/".$fetchData['user_image'];
    $dialog['username'] = $fetchData['user_full_name'];
    $dialog['address'] = $fetchData['order_location_adress'];
    $dialog['weight'] = (int) $fetchData['order_weight'];
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
 ?>
