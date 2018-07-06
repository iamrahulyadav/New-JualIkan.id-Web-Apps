<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_id']) && isset($_POST['fish_id']) && isset($_POST['koperasi_id'])) {

        //do something when right
        $user_id = $_POST['user_id'];
        $fish_id  = $_POST['fish_id'];
        $koperasi_id  = $_POST['koperasi_id'];

        $fish = array();
        $sqlReview = "SELECT * FROM fish_review WHERE user_id = '$user_id' AND fish_id = '$fish_id' AND koperasi_id = '$koperasi_id'";
        $resultReview = $connect->query($sqlReview);
        $review = $resultReview->fetch_assoc();
      
        $sqlFish = "SELECT * FROM fish WHERE fish_id = '$fish_id'";
        $resultFish = $connect->query($sqlFish);
        $fish = $resultFish->fetch_assoc();
        
        if($review != null){  
            //review sudah ada
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil ambil data";
            $response['review'] = $review;
            $response['fish'] = $fish;
        }else { 
            //review belum ada
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil ambil data";
            $response['fish'] = $fish;
        }
      
    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
