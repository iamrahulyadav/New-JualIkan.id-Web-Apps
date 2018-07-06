<?php
  include '../connect.php';

  $resposne = array();

  if (isset($_POST['user_id'])) {
      $idDriver = $_POST['user_id'];
    
      $items = array();
    
      $sqlProfile = "SELECT * FROM user_pengguna WHERE user_id = $idDriver";
      $resultProfile = $connect->query($sqlProfile);
      $rowProfile = $resultProfile->fetch_assoc();
    
      $profile['id'] = $rowProfile['user_id'];
      $profile['name'] = $rowProfile['user_full_name'];
      $profile['saldo'] = "Rp. " . $rowProfile['user_saldo'];
        
      $sql2 = "SELECT * FROM saldo_history WHERE saldo_user_id = $idDriver AND saldo_user_level = 1";
      $result2 = $connect->query($sql2);
      while ($row2 = $result2->fetch_assoc()) {
          $saldo['id'] = $row2['saldo_history_id'];
          $saldo['name'] = $row2['saldo_history_title'];
          $saldo['value'] = "Rp. " . $row2['saldo_value'];
          $items[] = $saldo;
      }

      $response['response'] = 200;
      $response['status'] = true;
      $response['message'] = "Data berhasil di ambil";
      $response['data']['profile'] = $profile;
      $response['data']['history'] = $items;
  }else {
      $response['response'] = 400;
      $response['status'] = false;
      $response['message'] = "Pastikan parameter anda terisi";
  }

  echo json_encode($response, JSON_PRETTY_PRINT);
?>
