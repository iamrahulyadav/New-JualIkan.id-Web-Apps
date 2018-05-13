<?php
    include 'connect.php';

    $id_koperasi = 4;

    //variable digunakan untuk menghitung vrp

    //berat pesanan total
    $weightSum = 0;
    $driverWeightSum = 0;

    //array lokasi index
    //ke-0 adalah id_pesanan,
    //ke-1 adalah lat_pesanan,
    //ke-2 adalah lng_pesanan,
    //ke-3 adalah berat_pesanan
    $arrayLocation = array();

    //array lokasi index
    //ke-0 adalah id_driver,
    //ke-1 adalah nama_driver,
    //ke-1 adalah muatan_driver,
    $arrayDriver = array();

    // fetch data koperasi
    $koperasi = koperasi($id_koperasi);
    echo "<h2 >Sample Menghitung VRP</h2>";

    $loc = array();
    $loc[] = "Koperasi";
    $loc[] = floatval($koperasi['koperasi_lat']);
    $loc[] = floatval($koperasi['koperasi_lng']);
    $loc[] = 0;
    $arrayLocation[] = $loc;

    //========================== Nama Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Koperasi</h4>";
    echo "<table width = 1000 border =1 style='text-align:center;' >
              <tr>
                  <th> Nama Koperasi </th>
                  <th> Alamat Koperasi </th>
                  <th> Posisi Koperasi </th>
              </tr>
              <tr>
                  <td> ".$koperasi['koperasi_name']."</td>
                  <td> ".$koperasi['koperasi_address']." </td>
                  <td> ".$koperasi['koperasi_lat']." ".$koperasi['koperasi_lng']."</td>
              </tr>
          </table>";

    //========================== Pesanan Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Daftar Order</h4>";
    echo "<table width = 1000 border =1 style='text-align:center;' >
              <tr>
                  <th> ID Order </th>
                  <th> Username </th>
                  <th> Location </th>
                  <th> Weight </th>
              </tr>";
    $newResult = pesanan($id_koperasi);
    while ($obj = $newResult->fetch_assoc()){
        $loc = array();
        $loc[] = "ID Order " . $obj['id'];
        $loc[] = floatval($obj['lat']);
        $loc[] = floatval($obj['lng']);
        $loc[] = (int)$obj['weight'];
        $weightSum = (int)$obj['weight'] + $weightSum;
        $arrayLocation[] = $loc;
        echo "<tr>
                  <td> ".$obj['id']."</td>
                  <td> ".$obj['username']." </td>
                  <td> ".$obj['lat']." ".$obj['lng']."</td>
                  <td> ".$obj['weight']." KG </td>
              </tr>";
    }
        echo "<tr>
                  <td></td>
                  <td></td>
                  <td><b>Total</b></td>
                  <td><b>".$weightSum." KG</b> </td>
              </tr>";
    echo "</table>";

    //========================== Profile Driver ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Daftar Order</h4>";
    echo "<table width = 1000 border =1 style='text-align:center;' >
              <tr>
                  <th> ID Driver </th>
                  <th> Driver </th>
                  <th> Weight </th>
              </tr>";
    $driver = driver($id_koperasi);
    while ($obj = $driver->fetch_assoc()){

        $obj2 = array();
        $obj2[] = $obj['driver_id'];
        $obj2[] = $obj['driver_full_name'];
        $obj2[] = (int)$obj['driver_vehicle_weight'];

        $driverWeightSum = $obj2[2] + $driverWeightSum;
        $arrayDriver[] = $obj2;

        echo "<tr>
                  <td> ".$obj['driver_id']."</td>
                  <td> ".$obj2[1]." </td>
                  <td> ".$obj2[2]." KG </td>
              </tr>";
    }
        echo "<tr>
                  <td></td>
                  <td><b>Total</b></td>
                  <td><b>".$driverWeightSum." KG</b> </td>
              </tr>";
    echo "</table>";

    //========================== menampilkan Jarak dan Berat Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Distance and Weight</h4>";
    echo "<table width = 1000 border =1 style='text-align:center;' >
              <tr>
                  <td>  </td>
                  <td> Koperasi </td>
                  ";
                  $newResult = pesanan(1);
                  while ($obj = $newResult->fetch_assoc()){
                      echo "<td> ID Order " . $obj['id'] . "</td>";
                  }
    echo "<td> Berat </td> </tr>";
    for ($i=0; $i < count($arrayLocation) ; $i++) {
        echo "<tr>";
        echo "<td> ". $arrayLocation[$i][0] ." </td>";
        for ($j=0; $j < count($arrayLocation); $j++) {
            echo "<td> ". countDistance($arrayLocation[$i][1], $arrayLocation[$i][2], $arrayLocation[$j][1], $arrayLocation[$j][2]) ." </td>";
        }
        echo "<td> ". $arrayLocation[$i][3] ." KG</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h4 style='margin-bottom:10px'>Route Pengiriman</h4>";
    echo $weightSum;

    countVRPByDistance($arrayLocation, $arrayDriver, $weightSum);
?>

<?php

    function koperasi($id){
        include 'connect.php';
        $sql = "SELECT * FROM user_koperasi WHERE koperasi_id = '$id'";
        $result = $connect->query($sql);
        return $result->fetch_assoc();
    }

    function driver($id){
        include 'connect.php';
        $sql = "SELECT * FROM user_driver WHERE driver_koperasi_id = '$id'";
        return $connect->query($sql);
    }

    function pesanan($id){
        include 'connect.php';
        $sql = "SELECT * FROM order_example";
        return $connect->query($sql);
    }

    function countDistance($lat1, $lng1, $lat2, $lng2){
        if (($lat1 == $lat2) && ($lng1 == $lng2)) {
            return 0;
        }else {
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
    }

    function countVRP($array, $driver, $weightSum){
        $i = 0;
        $searchIndex = 0;

        $choosen = array();

        $result = array();

        echo "</br>";
        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($driver)){


                $driverWeight = $driver[$indexDriver][2];

                $searchIndex = 0;

                $route = array();
                $routeAll = array();

                $routeAll[] = 0;

                // $route[] = 0;

                while ($driverWeight > 0) {
                    echo "Cari dari : ". $searchIndex . " | Dengan Berat : " . $array[$searchIndex][3] . " kg</br>";
                    echo "Nama Driver : " . $driver[$indexDriver][1] . "</br>";

                    $object = array();

                    $dis = 9999999999;
                    $index = 0;

                    for ($j=0; $j < count($array); $j++) {
                        if ($searchIndex != $j && $j != 0) {
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $array[$j][0]) {
                                    $bol = false;
                                }
                            }
                            if ($bol) {
                                $cDis = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[$j][1], $array[$j][2]);
                                if ($dis > $cDis) {
                                    $dis = $cDis;
                                    $index = $j;
                                }
                                echo "" . $j . "</br>";
                            }

                        }
                    }

                    // echo "choosen : ". $index . " | Dis : " . $dis . "</br>";

                    $object['route'] = $searchIndex . "->" . $index;
                    $object['distance'] = $dis;

                    $bol = true;
                    for ($k=0; $k < count($choosen); $k++) {
                        if ($choosen[$k] == $array[$index][0]) {
                            $bol = false;
                        }
                    }

                    echo "Muatan : " . $driverWeight . "KG | Berat : " . $array[$index][3] . "KG</br>";

                    if ($bol && $driverWeight > $array[$index][3] && $index != 0) {
                        $routeAll[] = $index;
                        $route[] = $object;

                        $choosen[] = $array[$index][0];
                        $searchIndex = $index;

                        $driverWeight = $driverWeight - $array[$searchIndex][3];
                        $weightSum = $weightSum - $array[$searchIndex][3];
                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                        echo "Reset</br></br>";
                    }
                }

                $object['route'] = $searchIndex . "->0";
                $object['distance'] = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[0][1], $array[0][2]);
                $route[] = $object;

                $routeAll[] = 0;

                $result_item  = array();
                $result_item['route_all'] = $routeAll;
                $result_item['driver'] = $driver[$indexDriver-1];
                $result_item['route_item'] = $route;

                $result[] = $result_item;

                echo "Count Choosen : " . count($choosen) . " | Count Pesanan : " . count($array) . "</br>";

                if (count($choosen) < count($array) - 1) {
                    if ($indexDriver == count($driver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                }

                echo "Index Driver : ". $indexDriver . "</br >";


                echo json_encode($choosen);
                echo "</br>";
                echo "</br>";

            }

            echo "</br>Weight Sum  : " .$weightSum . "</br>";

            // $dis = 9999999999;
            // for ($j=0; $j < count($array); $j++) {
            //     if($i != $j){
            //         if ($dis > countDistance($array[$i][1], $array[$i][2], $array[$j][1], $array[$j][2])) {
            //             $dis = countDistance($array[$i][1], $array[$i][2], $array[$j][1], $array[$j][2]);
            //         }
            //     }
            // }
            //
            // // echo $i . "    ";
            // // echo "berat " . $weightSum . "</br>";
            // // echo "dis : ". $dis . "</br>";
            // // echo "</br>";
            // $weightSum = $weightSum - $array[$i][3];
            // $i++

            ;
        }

        echo "Result : VRP  </br>";
        echo json_encode($result);
    }

    function countVRPByDistance($array, $driver, $weightSum){

        $choosen = array();
        $result = array();

        $i = 0;
        $searchIndex = 0;

        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($driver)){

                $driverWeight = $driver[$indexDriver][2];

                $route = array();
                $routeAll = array();

                $searchIndex = 0;
                $routeAll[] = 0;

                while ($driverWeight > 0) {

                    $object = array();

                    $dis = 9999999999;
                    $index = 0;

                    for ($j=0; $j < count($array); $j++) {
                        if ($searchIndex != $j && $j != 0) {
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $array[$j][0]) {
                                    $bol = false;
                                }
                            }
                            if ($bol) {
                                $cDis = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[$j][1], $array[$j][2]);
                                if ($dis > $cDis) {
                                    $dis = $cDis;
                                    $index = $j;
                                }
                            }

                        }
                    }

                    $object['route'] = $searchIndex . "->" . $index;
                    $object['distance'] = $dis;

                    $bol = true;
                    for ($k=0; $k < count($choosen); $k++) {
                        if ($choosen[$k] == $array[$index][0]) {
                            $bol = false;
                        }
                    }

                    if ($bol && $driverWeight > $array[$index][3] && $index != 0) {
                        $routeAll[] = $index;
                        $route[] = $object;

                        $choosen[] = $array[$index][0];
                        $searchIndex = $index;

                        $driverWeight = $driverWeight - $array[$searchIndex][3];
                        $weightSum = $weightSum - $array[$searchIndex][3];
                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                    }
                }

                $object['route'] = $searchIndex . "->0";
                $object['distance'] = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[0][1], $array[0][2]);
                $route[] = $object;

                $routeAll[] = 0;

                $result_item  = array();
                $result_item['route_all'] = $routeAll;
                $result_item['driver'] = $driver[$indexDriver-1];
                $result_item['route_item'] = $route;

                $result[] = $result_item;

                if (count($choosen) < count($array) - 1) {
                    if ($indexDriver == count($driver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                }
                // echo json_encode($choosen);

            }
        }

        echo json_encode($result);
    }

?>
