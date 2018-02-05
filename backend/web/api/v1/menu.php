<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['lat']) &&
        isset($_POST['lng'])) {

        //do something when right
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        $id_location = 0;

        $distribtution = array();
        $sqlDistribution = "SELECT * FROM distribution_location";
        $resultDistribution = $connect->query($sqlDistribution);
        while ($row = $resultDistribution->fetch_assoc()) {
            $distribtution[] = array(
                'distance' => countDistance(floatval($lat), floatval($lng), floatval($row['distribution_lat']), floatval($row['distribution_lng'])),
                'id_location' => $row['distribution_id']
            );
        }

        usort($distribtution, function($a, $b){
            if (intval($a['distance']) == intval($b['distance'])) {
                return 0;
            }
            return (intval($a['distance']) < intval($b['distance'])) ? -1 : 1;
        });

        $id_location = $distribtution[0]['id_location'];

        $promo = array();
        $sqlPromo = "SELECT * FROM promo";
        $resultPromo = $connect->query($sqlPromo);
        while ($row = $resultPromo->fetch_assoc()) {
            $promo[] = $row;
        }

        $fish_cat = array();

        // terbaru
        $fish = array();
        $sqlFish = "SELECT * FROM fish WHERE fish_distribution_location = '$id_location' ORDER BY fish_date DESC LIMIT 0, 4";
        $resultFish = $connect->query($sqlFish);
        while ($row1 = $resultFish->fetch_assoc()) {
            $fish[] = $row1;
        }

        $fish_cat[] = array(
            'fish_category_id' => '0',
            'fish_category_name' => 'Terbaru',
            'distribution_location_id' => $id_location,
            'fish_item' => $fish
        );

        //berdasarkan kategori
        $sqlFishCat = "SELECT * FROM fish_category";
        $resultFishCat = $connect->query($sqlFishCat);
        while ($row = $resultFishCat->fetch_assoc()) {
            $fish = array();
            $id = $row['fish_category_id'];

            $sqlFish = "SELECT * FROM fish WHERE fish_distribution_location = '$id_location' AND fish_category_id = '$id' ORDER BY fish_date DESC LIMIT 0, 4";
            $resultFish = $connect->query($sqlFish);
            while ($row1 = $resultFish->fetch_assoc()) {
                $fish[] = $row1;
            }

            $fish_cat[] = array(
                'fish_category_id' => $row['fish_category_id'],
                'fish_category_name' => $row['fish_category_name'],
                'distribution_location_id' => $id_location,
                'fish_item' => $fish
            );
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil Ambil Menu";
        $response['data'] = array(
            'promo' => $promo,
            'fish_cat' => $fish_cat,
        );

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

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
