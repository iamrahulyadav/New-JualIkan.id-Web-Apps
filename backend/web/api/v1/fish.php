<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['fish_id'])) {

        //do something when right
        $fish_id = $_POST['fish_id'];

        $fish = array();

        $sqlFish = "SELECT * FROM fish WHERE fish_id = '$fish_id'";
        $resultFish = $connect->query($sqlFish);
        while ($row = $resultFish->fetch_assoc()) {

          //fish category
          $fish_category_id = $row['fish_category_id'];
          $sql1 = "SELECT * FROM fish_category WHERE fish_category_id = '$fish_category_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_category_id = $row1['fish_category_name'];
          }

          //fish condition
          $fish_condition_id = $row['fish_condition_id'];
          $sql1 = "SELECT * FROM fish_condition WHERE fish_condition_id = '$fish_condition_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_condition_id = $row1['fish_condition_name'];
          }

          //fish size
          $fish_size_id = $row['fish_size_id'];
          $sql1 = "SELECT * FROM fish_size WHERE fish_size_id = '$fish_size_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_size_id = $row1['fish_size_name'];
          }

            $fish = array(
                'fish_id' => $row['fish_id'],
                'fish_image' => $row['fish_image'],
                'fish_name' => $row['fish_name'],
                'fish_price' => $row['fish_price'],
                'fish_distribution_location' => $row['fish_distribution_location'],
                'fish_category_id' => $fish_category_id,
                'fish_condition_id' => $fish_condition_id,
                'fish_size_id' => $fish_size_id,
                'fish_stock' => $row['fish_stock'],
                'fish_description' => $row['fish_description'],
                'fish_date' => $row['fish_date'],
            );
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil Ambil kategori";
        $response['data'] = $fish;

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
