<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_id'])) {

        //do something when right
        $user_id = $_POST['user_id'];

        $sqlReview = "SELECT * FROM user_pengguna WHERE user_id = '$user_id'";
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
