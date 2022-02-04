<?php
include_once "dbConnect.php";
session_start();
    $roomType = $_POST['roomType'];
    $roomName = $_POST['roomName'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $duration = $_POST['duration'];
    $total = $_POST['total'];
    $customerFName = $_POST['customer_firstName'];
    $customerLName = $_POST['customer_lastName'];
    $customerContact = $_POST['customerContact'];
    $customerEmail = $_POST['customerEmail'];
    $customerIdCard = $_POST['customerIdCard'];

    $sql="INSERT INTO `booking`(`Customer_Name`, `Customer_Contact`, `Customer_Email`, `Customer_IdCard`, `Room_Type_Id`, `Room_Name`, `Duration`, `Check_In`, `Check_Out`, `Total`) VALUES ( '$customerFName $customerLName', '$customerContact', '$customerEmail', '$customerIdCard', '$roomType','$roomName','$duration','$checkInDate','$checkOutDate','$total')";

    $result = mysqli_query($conn, $sql);
    if($result){
       updateRoomStatus($conn, $roomName);
    }else{
        header("Location: ../index.php?booking&failed");
        exit();
    }

    function updateRoomStatus($conn, $room){
        $sql ="UPDATE `rooms` SET `Status`='Booked' WHERE `Room_Name`='$room'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../index.php?booking&success");
            exit();
        }else{
            header("Location: ../index.php?booking&failed=update");
            exit();
        }
    

    }
?>
