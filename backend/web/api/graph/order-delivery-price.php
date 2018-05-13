<?php
    include '../connect.php';

    $id = $_GET['id'];

    $month = Date('m');
    $last  = date('t');
    $response = array();

    for ($i = 1; $i <= $last; $i++){

        $tanggal = "0";

        if ($i < 10) {
            $tanggal = "0" . $i;
        } else {
            $tanggal = $i;
        }

        $date = Date('Y-'. $month. '-'.$tanggal);

        $obj = array();
        $obj["id"] = $i;
        $obj["date"] = $date;

        $sql1 = "SELECT * FROM `order` WHERE order_koperasi_location_id = '$id' and order_date like '%{$date}%' and order_status = 3";
        $res1 = $connect->query($sql1);

        $tot1 = 0;

        while($row1 = $res1->fetch_assoc()){
            $tot1 = (int) $row1['order_payment_total'] + $tot1;
        }

        $obj["order_text"] = "Order ";
        $obj["order"] = $tot1;

        $sql2 = "SELECT * FROM delivery WHERE delivery_order_koperasi_id = '$id' and delivery_time_depart like '$date'";
        $res2 = $connect->query($sql2);
        $row2 = $res2->num_rows;

        $tot2 = 0;

        while($row2 = $res2->fetch_assoc()){
            $tot2 = (int) $row2['delivery_payment'] + $tot2;
        }

        $obj["delivery_text"] = "Delivery";
        $obj["delivery"] = $tot2;

        $response[] = $obj;
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
