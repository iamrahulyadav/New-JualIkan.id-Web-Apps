<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_id']) && isset($_POST['saldo'])) {
        $user_id = $_POST['user_id'];
        $saldo = $_POST['saldo'];
      
        $sqlUser = "SELECT * FROM user_pengguna WHERE user_id = '$user_id'";
        $resultUser = $connect->query($sqlUser);
        $user = $resultUser->fetch_assoc();
      
        if($user != null){
            $saldoSekarang = (int) $user['user_saldo'] + (int) $saldo;
            
            $sql = "UPDATE user_pengguna SET user_saldo = '$saldoSekarang' WHERE user_id = '$user_id'";
            $connect->query($sql);  
          
            udpateSaldoDriver($user_id, $saldo);  
          
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Saldo berhasil di tambahkan";
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "User tidak ditemukan";
        }
    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

    function udpateSaldoDriver($driver_id, $value){
        include '../connect.php';

        $title = "Top-Up Rp. ". $value;

        $sql = "INSERT INTO saldo_history (
                  saldo_history_title,
                  saldo_user_id,
                  saldo_user_level,
                  saldo_value)
                VALUES (
                  '$title',
                  '$driver_id',
                  1,
                  '$value'
                )";

        $connect->query($sql);
    }
?>
