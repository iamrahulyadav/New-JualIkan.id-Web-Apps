<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_id']) && isset($_POST['fish_id']) && isset($_POST['koperasi_id']) && isset($_POST['review_text']) && isset($_POST['review_value'])) {

        //do something when right
        $user_id = $_POST['user_id'];
        $fish_id  = $_POST['fish_id'];
        $koperasi_id  = $_POST['koperasi_id'];
        $review_text = $_POST['review_text'];
        $review_value = $_POST['review_value'];

        $fish = array();
        $sqlReview = "SELECT * FROM fish_review WHERE user_id = '$user_id' AND fish_id = '$fish_id' AND koperasi_id = '$koperasi_id'";
        $resultReview = $connect->query($sqlReview);
        $review = $resultReview->fetch_assoc();
        
        if($review != null){  
            //review sudah ada

            //doing update
            $sql = "UPDATE fish_review SET review_text = '$review_text', review_jumalh = '$review_value' WHERE user_id = '$user_id' AND fish_id = '$fish_id' AND koperasi_id = '$koperasi_id'";
            $connect->query($sql);
            
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil update review";
        }else { 
            //review belum ada
          
            //doing insert
            $sql = "INSERT INTO fish_review (
                  user_id,
                  fish_id,
                  koperasi_id,
                  review_text,
                  review_jumalh
              ) VALUES (
                  '$user_id',
                  '$fish_id',
                  '$koperasi_id',
                  '$review_text',
                  '$review_value'
              )";
            $connect->query($sql);
          
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil tambah review";
        }
      
    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
