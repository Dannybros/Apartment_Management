<?php
include_once "dbConnect.php";
session_start();

    //info for booking
    $roomName = $_POST['roomName'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $duration = $_POST['duration'];
    $total = $_POST['total'];

    /// info for customer
    $customerFName = $_POST['customer_firstName'];
    $customerLName = $_POST['customer_lastName'];
    $customerContact = $_POST['customerContact'];
    $customerEmail = $_POST['customerEmail'];
    $customerIdCard = $_POST['customerIdCard'];

    insertCustomer($conn, $customerFName, $customerLName, $customerContact, $customerEmail, $customerIdCard);
    
    insertBooking($conn, $roomName, $customerIdCard, $checkInDate, $checkOutDate, $duration, $total);

    updateRoomStatus($conn, $roomName);

    function insertCustomer($conn, $fname, $lname, $contact, $email, $idCard){
        $sql = "INSERT INTO `customer`(`Customer_Name`, `Customer_Contact`, `Customer_Email`, `Customer_ID_Card`) VALUES ('$fname $lname', '$contact', '$email', '$idCard')";
        $result = mysqli_query($conn, $sql);

        if($result){
            return true;
            }else{
            header("Location: ../index.php?booking&failed");
            exit();
            }
    }

    function insertBooking($conn, $roomName, $customerIdCard, $d1, $d2, $duration, $total){
        $sql="INSERT INTO `booking`(`Customer_ID_Card`, `Room_Name`, `Duration`, `Check_In`, `Check_Out`, `Total`) VALUES ('$customerIdCard', '$roomName', '$duration', '$d1', '$d2', '$total')";

        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
         }else{
            header("Location: ../index.php?booking&failed");
            exit();
         }
    }

    function updateRoomStatus($conn, $room){
        $sql ="UPDATE `rooms` SET `Status`='Booked' WHERE `Room_Name`='$room'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../index.php?booking&success");
            exit();
        }else{
            header("Location: ../index.php?booking&failed");
            exit();
        }
    }
?>
