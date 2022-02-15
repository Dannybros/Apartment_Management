<?php
include_once ("../dbConnect.php");
session_start();

if(isset($_POST['roomType__name'])){
    $name = $_POST['roomType__name'];
    $price = $_POST['roomType__price'];

    AddRoomType($conn, $name, $price);

    mysqli_close($conn);
}

if(isset($_POST['staffType__name'])){
    $name = $_POST['staffType__name'];

    AddStaffType($conn, $name);

    mysqli_close($conn);
}

if(isset($_POST['shift__name'])){
    $name = $_POST['shift__name'];
    $time = $_POST['shift__time'];

    AddShiftType($conn, $name, $time);

    mysqli_close($conn);
}


function AddRoomType($conn, $name, $price){
    $sql ="INSERT INTO `room_type`( `Room_Type_Name`, `Room_Type_Price`) VALUES ('$name','$price')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=roomTypeNew");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

function AddStaffType($conn, $name){
    $sql ="INSERT INTO `staff_type`(`Staff_Job_Name`) VALUES ('$name')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=staffTypeNew");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

function AddShiftType($conn, $name, $time){
    $sql ="INSERT INTO `shift`( `Shift_Name`, `Shift_Time`) VALUES ('$name','$time')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=shiftTypeNew");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

?>