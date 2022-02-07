<?php
include_once ("dbConnect.php");
session_start();

if(isset($_POST['room_modal_type'])){
    $room_id = $_POST['room__id'];
    $room_name = $_POST['room__name'];
    $room_type = $_POST['room_modal_type'];

    UpdateRoomInfo($conn, $room_name, $room_type, $room_id);

    mysqli_close($conn);

}elseif (isset($_POST['room_stay_duration'])){
    $room_id = $_POST['room__id'];
    $checkIn = $_POST['room_check_in'];
    $checkOut = $_POST['room_check_out'];
    $duration = $_POST['room_stay_duration'];
    $total = $_POST['room_price_total'];

    UpdateDateStay($conn, $duration, $checkIn, $checkOut, $total, $room_id);

    mysqli_close($conn);
   
}else{
    header("Location:../404.php");
}

function UpdateRoomInfo($conn, $room_name, $room_type, $room_id){
    $sql ="UPDATE `rooms` SET `Room_Name`='$room_name',`Room_Type_Id`='$room_type' WHERE `Room_Id`='$room_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../index.php?room&success");
        exit();
    } else {

        header("Location:../index.php?room&error");
        exit();
    }
}


function UpdateDateStay($conn, $duration, $checkIn, $checkOut, $total, $room_id){
    $sql="UPDATE `booking` SET `Duration`='$duration',`Check_In`='$checkIn',`Check_Out`='$checkOut',`Total`='$total' WHERE `Room_Id`='$room_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../index.php?room&success");
        exit();
    } else {

        header("Location:../index.php?room&error");
        exit();
    }
}
?>