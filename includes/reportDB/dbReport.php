<?php
include_once ("../dbConnect.php");
session_start();
    $return_arr = array();

    $date = $_POST['date'];
    
    $search = $_POST['search'];

    if($date==""){
        $query = "SELECT * FROM `booking` NATURAL JOIN rooms NATURAL JOIN customer NATURAL JOIN room_type WHERE `Room_Name` LIKE '%$search%' OR `Customer_Name` LIKE '%$search%' ORDER BY Room_Name;";
    }else{
        $month = (int)explode("-", $date)[1];
        $total_month = (int)explode("-", $date)[0] * 12 + $month;

        $query = "SELECT *
                FROM `booking` NATURAL JOIN rooms NATURAL JOIN customer NATURAL JOIN room_type
                WHERE ($total_month BETWEEN CAST(SUBSTRING(`Check_In`, 1, 4) AS INT) * 12 + CAST(SUBSTRING(`Check_In`, 6, 2) AS INT) 
                    AND CAST(SUBSTRING(`Check_Out`, 1, 4) AS INT) * 12 + CAST(SUBSTRING(`Check_Out`, 6, 2) AS INT)) 
                AND (`Room_Name` LIKE '%$search%' OR `Customer_Name` LIKE '%$search%')";
    }

    $result = mysqli_query($conn, $query);

    while($booking = mysqli_fetch_array($result)){
        $id = $booking['Booking_Id'];
        $c_name = $booking['Customer_Name'];
        $r_name = $booking['Room_Name'];
        $price = $booking['Room_Type_Price']; 
        $check_in = $booking['Check_In'];
        $check_out = $booking['Check_Out'];
        $duration = $booking['Duration'];
        $total = $booking['Total'];

        $return_arr[] = array(
            "id" => $id,
            "c_name" => $c_name,
            "r_name" => $r_name,
            "price" => $price,
            "check_in" => $check_in,
            "check_out" => $check_out,
            "duration" => $duration,
            "total" => $total
        );
    }

    echo json_encode($return_arr);
?>