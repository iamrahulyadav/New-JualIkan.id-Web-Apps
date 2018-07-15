<?php
  include 'connect.php';
  $id = $_GET['id'];
  $resultFinal = array();

  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d');
  $time_min = date('H:m:s');
//   $time_min = "17:00:00";
  $time_max = "24:00:00";

//   $sql = "SELECT delivery_time.*, `order`.*, user_pengguna.* FROM `order` as `order`, delivery_time as delivery_time, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and `order`.order_delivery_time_id and delivery_time.delivery_time_start between '$time_min' and '$time_max'";
  $sql = "SELECT * FROM `order_example`";
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
    $marker[] = floatval($fetchData['lat']);
    $marker[] = floatval($fetchData['lng']);
    
    $delivery_time['id'] = 1;
    $delivery_time['start'] = "09:00:00";
    $delivery_time['end'] = "10:00:00";

    $dialog = array();
    $dialog['id'] = (int)$fetchData['id'];
    $dialog['image'] = "http://ishom.jagopesan.com/jualikan.id/".$fetchData['image'];
    $dialog['username'] = $fetchData['username'];
    $dialog['address'] = $fetchData['address'];
    $dialog['weight'] = (int) $fetchData['weight'];
    $dialog['delivery_time'] = $delivery_time;
    $dialog['price'] = (int) $fetchData['price'];
    $dialog['lat'] = (double) $fetchData['lat'];
    $dialog['lng'] = (double) $fetchData['lng'];

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
