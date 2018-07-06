<?php
  include 'connect.php';
  $id = $_GET['id'];
  $queryResult = $connect->query("SELECT * FROM delivery_time WHERE delivery_time_koperasi_id = '$id'");
  $result = array();
  while($fetchData = $queryResult->fetch_assoc()){
    $result[] = $fetchData;
  }
  echo json_encode($result);
  // echo json_encode($result);
 ?>
