<?php
    include '../../connect.php';

    $response = array();

    if (isset($_POST['driver_id'])) {

        //do something when right
        $driver_id = $_POST['driver_id'];

        $sqlReview = "SELECT * FROM user_driver WHERE driver_id = '$driver_id'";
        $resultReview = $connect->query($sqlReview);
        $profile = $resultReview->fetch_assoc();
      
        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil ambil data";
        $response['profile'] = $profile;
      
    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
