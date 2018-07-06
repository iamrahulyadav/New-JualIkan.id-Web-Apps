<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_id']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {
        $user_id = $_POST['user_id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
      
        $sqlUser = "SELECT * FROM user_pengguna WHERE user_id = '$user_id'";
        $resultUser = $connect->query($sqlUser);
        $user = $resultUser->fetch_assoc();
      
//         $sql = "UPDATE user_pengguna SET user_full_name = '$user_full_name', user_email = '$user_email', user_phone = '$user_phone' WHERE user_id = '$user_id'";
        if($user['user_password'] == $old_password){

            $sql = "UPDATE user_pengguna SET user_password = '$new_password' WHERE user_id = '$user_id'";
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
