<?php
  include 'connect.php';
  $id = $_GET['id'];
  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d');
  $queryResult = $connect->query("SELECT * FROM delivery_time WHERE delivery_time_koperasi_id = '$id'");
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $obj = array();
    $time_id = $fetchData['delivery_time_id'];
    
    $sql = "SELECT COUNT(*) as total FROM `order` as `order`, user_pengguna as user_pengguna WHERE user_pengguna.user_id = `order`.order_user_id and `order`.order_koperasi_location_id = $id and `order`.order_delivery_time_id = $time_id and `order`.order_date like '%$date%' and `order`.order_status = 1";
    $resultSql = $connect->query($sql);
    $row = $resultSql->fetch_assoc();
    
    $obj['id']  = $fetchData['delivery_time_id'];
    $obj['delivery_time_start'] = $fetchData['delivery_time_start'];
    $obj['delivery_time_end'] = $fetchData['delivery_time_end'];
    $obj['total'] = $row['total'];
    
    $result[] = $obj;
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
