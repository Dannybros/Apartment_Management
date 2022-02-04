<?php
include_once ("dbConnect.php");
session_start();

if(isset($_POST['room_modal_type'])){
    $room_id = $_POST['room__id'];
    $room_name = $_POST['room__name'];
    $room_type = $_POST['room_modal_type'];

    $sql ="UPDATE `rooms` SET `Room_Name`='$room_name',`Room_Type_Id`='$room_type' WHERE `Room_Id`='$room_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../index.php?room&success");
        exit();
    } else {

        header("Location:../index.php?room&error");
        exit();
    }

    mysqli_close($conn);

}elseif (isset($_POST['customer_contact'])){
    $room_name = $_POST['room__name'];
    $name = $_POST['customer_name'];
    $contact = $_POST['customer_contact'];
    $email = $_POST['customer_email'];
    $idCard = $_POST['customer_ID'];
    $checkIn = $_POST['room_check_in'];
    $checkOut = $_POST['room_check_out'];
    $duration = $_POST['room_stay_duration'];
    $total = $_POST['room_price_total'];

    $sql="UPDATE `booking` SET `Customer_Name`='$name',`Customer_Contact`='$contact',`Customer_Email`='$email',`Customer_IdCard`='$idCard',`Duration`='$duration',`Check_In`='$checkIn',`Check_Out`='$checkOut',`Total`='$total' WHERE `Room_Name`='$room_name'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../index.php?room&success");
        exit();
    } else {

        header("Location:../index.php?room&error");
        exit();
    }

    mysqli_close($conn);
   
}else{
    header("Location:../404.php");
}
?>