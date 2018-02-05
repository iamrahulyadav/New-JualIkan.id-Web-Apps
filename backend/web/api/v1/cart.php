<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['fish_id']) && isset($_POST['user_id']) && isset($_POST['total'])) {
        //do something when right
        $fish_id = $_POST['fish_id'];
        $user_id = $_POST['user_id'];
        $total = $_POST['total'];
        $status = 0;

        $fish = array();
        $sql = "SELECT * FROM cart WHERE cart_user_id = '$user_id' AND cart_fish_id = '$fish_id' AND cart_status = '$status'";
        $result = $connect->query($sql);
        $size = $result->num_rows;
        echo $size;

        if ($size != 0) {
            $object = array();

            //ambil cart_id
            while ($row = $result->fetch_assoc()){
                $object = $row;
            }
            $id = $object['cart_id'];

            //cek apakah dia delete chart atau update qty
            if ($total == 0) {
                //berarti dia delete

            }else {
                //berarti dia update
                $sql = "UPDATE cart SET cart_fish_qty = '$total' WHERE cart_id = '$id'";
                $connect->query($sql);
            }





            $sql = "SELECT * FROM cart WHERE cart_user_id = '$user_id' AND cart_status = '$status'";
            $result = $connect->query($sql);

            while ($row = $result->fetch_assoc()){
                $object = $row;
            }


        }else {
          echo "gak onok";
        }

        // $response['response'] = 200;
        // $response['status'] = true;
        // $response['message'] = "Berhasil ambil bantuan";
        // $response['data'] = $fish;
    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
