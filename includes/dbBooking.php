<?php
include_once "dbConnect.php";
session_start();

    //info for booking
    $room_id = $_POST['available_room_id'];
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
    
    insertBooking($conn, $room_id, $customerIdCard, $checkInDate, $checkOutDate, $duration, $total);

    updateRoomStatus($conn, $room_id);

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

    function insertBooking($conn, $room_id, $customerIdCard, $d1, $d2, $duration, $total){
        $c_id = getCustomerID($conn, $customerIdCard);
        $sql="INSERT INTO `booking`(`Customer_ID`, `Room_Id`, `Duration`, `Check_In`, `Check_Out`, `Total`) VALUES ('$c_id', '$room_id', '$duration', '$d1', '$d2', '$total')";

        $result = mysqli_query($conn, $sql);
        if($result){
            return true;
         }else{
            header("Location: ../index.php?booking&failed");
            exit();
         }
    }
    
    function getCustomerID($conn, $customerIdCard){
        $sql = "SELECT `Customer_ID` FROM `customer` WHERE `Customer_ID_Card`='$customerIdCard'";

        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
        return $data['Customer_ID'];
    }

    function updateRoomStatus($conn, $room_id){
        $sql ="UPDATE `rooms` SET `Status`='Booked' WHERE `Room_Id`='$room_id'";
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
