<?php
    include '../../connect.php';

    $response = array();

    if (isset($_POST['driver_id']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {
        $driver_id = $_POST['driver_id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
      
        $sqlUser = "SELECT * FROM user_driver WHERE driver_id = '$driver_id'";
        $resultUser = $connect->query($sqlUser);
        $user = $resultUser->fetch_assoc();
      
//         $sql = "UPDATE user_pengguna SET user_full_name = '$user_full_name', user_email = '$user_email', user_phone = '$user_phone' WHERE user_id = '$user_id'";
        if($user['driver_password'] == $old_password){

            $sql = "UPDATE user_driver SET driver_password = '$new_password' WHERE driver_id = '$driver_id'";
            $connect->query($sql);  
          
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil update password";
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Password lama anda salah";
        }
    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
