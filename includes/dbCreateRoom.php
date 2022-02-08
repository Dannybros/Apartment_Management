<?php
include_once ("dbConnect.php");
session_start();
if(isset($_POST['room__name'])){
    $room_name = $_POST['room__name'];
    $room_type_id = $_POST['room_modal_type'];

    createNewRoom($conn, $room_name, $room_type_id);
    mysqli_close($conn);
}

function createNewRoom($conn, $room_name, $room_type_id){
    $sql="INSERT INTO `rooms`(`Room_Name`, `Room_Type_Id`, `Status`) VALUES ('$room_name', '$room_type_id', 'Free')";

    $result=mysqli_query($conn, $sql);

    if ($result){
        header("Location:../index.php?room&success=customerInfo");
        exit();
    }else{
        header("Location:../index.php?room&error");
        exit();
    }
}
?>