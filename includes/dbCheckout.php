<?php
include_once ("dbConnect.php");
session_start();

    $checkoutTime= $_GET['checkout'];
    $room_id = $_GET['id'];
    
    if($checkoutTime=="earlier"){

        $duration = $_GET['duration'];
        $d2 = $_GET['d2'];
        $total = $_GET['total'];
        $room_name = $_GET['room'];


        UpdateBookingInfo($conn, $duration, $d2, $total, $room_name);
        FreeRoom($conn, $room_id);

    }else{
        FreeRoom($conn, $room_id);
    }

    function UpdateBookingInfo($conn, $duration, $d2, $total, $room_name){
        $sql = "UPDATE `booking` SET `Duration`='$duration',`Check_Out`='$d2',`Total`='$total' WHERE `Room_Name`='$room_name'";

        $result = mysqli_query($conn, $sql);
    
        if($result){
           return true;
        }else{
            echo "failed";
        }
    }

    function FreeRoom($conn, $room_id){
        $sql= "UPDATE `rooms` SET `Status`='Free' WHERE `Room_Id`='$room_id'";
    
        $result = mysqli_query($conn, $sql);
    
        if($result){
            echo "success";
        }else{
            echo "failed";
        }
    }

?>