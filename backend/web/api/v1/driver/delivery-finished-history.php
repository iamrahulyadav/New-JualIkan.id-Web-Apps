<?php
  include '../../connect.php';

  $resposne = array();

  if (isset($_POST['driver_id'])) {
      $idDriver = $_POST['driver_id'];
    
      $delivery = array();

      $sql2 = "SELECT * FROM delivery WHERE delivery_driver_id = $idDriver AND delivery_status = 2 ORDER BY delivery_time_depart DESC";
      $result2 = $connect->query($sql2);
      while ($row2 = $result2->fetch_assoc()) {
          $last_deliver['id'] = $row2['delivery_id'];
          $last_deliver['code'] = "Pengiriman ID-" . $row2['delivery_code'];
          $last_deliver['order_count'] = count(json_decode($row2['delivery_order_id']));
          $last_deliver['date_time'] = $row2['delivery_time_depart'];
          $last_deliver['distance'] = distanceFormat((int)$row2['delivery_travel_distance']);
          $last_deliver['time'] = timeFormat((int)$row2['delivery_travel_time']);
          $last_deliver['status'] = (int)$row2['delivery_status'];
          $delivery[] = $last_deliver;
      }

      $response['response'] = 200;
      $response['status'] = true;
      $response['message'] = "Data berhasil di ambil";
      $response['data'] = $delivery;

  }else {
      $response['response'] = 400;
      $response['status'] = false;
      $response['message'] = "Pastikan parameter anda terisi";
  }

  echo json_encode($response, JSON_PRETTY_PRINT);

  function timeFormat($seconds){
      $hours = floor($seconds / 3600);
      $mins = floor($seconds / 60 % 60);
      $secs = floor($seconds % 60);

      if ($hours != 0) {
          if ($menit != 0) {
              return $hours . " Jam " . $mins . " Menit";
          }else {
              return $hours . " Jam";
          }
      }else {
          if ($mins != 0) {
              return $mins . " Menit";
          }else {
              return $secs . " Detik";
          }
      }
  }

  function distanceFormat($seconds){
      $km = floor($seconds / 1000);
      $rm = floor($seconds / 100 % 10);

      return $km . "," . $rm . " KM";
  }
?>
