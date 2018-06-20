<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['lat']) &&
        isset($_POST['lng']) &&
        isset($_POST['user_id'])) {

        //do something when right
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $user_id = $_POST['user_id'];

        //id lokasi
        $id_location = 0;

        //jarak koperasi sekitar => 50 km
        $radiusDistance = 50000;

        //menyimpan lokasi koperasi dengan radius xx km

        $promo = array();
        $sqlPromo = "SELECT * FROM promo";
        $resultPromo = $connect->query($sqlPromo);
        while ($row = $resultPromo->fetch_assoc()) {
            $promo[] = $row;
        }

        //menyimpan kategori ikan
        $fish_cat = array();

        //ambil data kategori terbaru
        $fish = array();
        $sqlFish = "SELECT fish.* FROM fish as fish ORDER BY fish.fish_date DESC LIMIT 0, 4";
        $resultFish = $connect->query($sqlFish);
        while ($row1 = $resultFish->fetch_assoc()) {
            if(count($fish) < 4){
                $fish[] = $row1;
            }
        }

        //simpan ke katgori ikan
        $fish_cat[] = array(
            'fish_category_id' => '0',
            'fish_category_name' => 'Terbaru',
            'fish_item' => $fish
        );

        //ambil data kategori ikan
        $sqlFishCat = "SELECT * FROM fish_category";
        $resultFishCat = $connect->query($sqlFishCat);
        while ($row = $resultFishCat->fetch_assoc()) {

            // tempat untuk menyimpan ikan
            $fish = array();
            //id kategori ikan
            $id = $row['fish_category_id'];

            $sqlFish = "SELECT fish.* FROM fish as fish WHERE fish.fish_category_id = '$id' ORDER BY fish.fish_date DESC LIMIT 0, 4";
            $resultFish = $connect->query($sqlFish);
            while ($row1 = $resultFish->fetch_assoc()) {
                  $fish[] = $row1;
            }
          
            $fish_cat[] = array(
                'fish_category_id' => $row['fish_category_id'],
                'fish_category_name' => $row['fish_category_name'],
                'fish_item' => $fish
            );
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil Ambil Menu";
        $response['data'] = array(
            'promo' => $promo,
            'fish_cat' => $fish_cat,
            'order_total' => (int)countOrderDalamProses($user_id),
        );

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

    function countOrderDalamProses($id_user){
        include '../connect.php';
        $sql = "SELECT count(*) as total FROM `order` WHERE (order_status = '0' or order_status = '1' or order_status = '2') and (`order_user_id` = '$id_user')";
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    function countDistance($lat1, $lng1, $lat2, $lng2){
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lng1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lng2);

        $earthRadius = 6371000;

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }
?>
