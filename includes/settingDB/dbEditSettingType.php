<?php
include_once ("../dbConnect.php");
session_start();

if(isset($_POST['roomType__name'])){
    $id = $_POST['roomType__id'];
    $name = $_POST['roomType__name'];
    $price = $_POST['roomType__price'];

    UpdateRoomType($conn, $id, $name, $price);

    mysqli_close($conn);
}

if(isset($_POST['staffType__name'])){
    $id = $_POST['staffType__id'];
    $name = $_POST['staffType__name'];

    UpdateStaffType($conn, $id, $name);

    mysqli_close($conn);
}

if(isset($_POST['shift__name'])){
    $id = $_POST['shift__id'];
    $name = $_POST['shift__name'];
    $time = $_POST['shift__time'];
    
    UpdateShiftType($conn, $id, $name, $time);

    mysqli_close($conn);
}


function UpdateRoomType($conn, $id, $name, $price){
    $sql ="UPDATE `room_type` SET `Room_Type_Name`='$name',`Room_Type_Price`='$price' WHERE `Room_Type_Id`='$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=editRoomType");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

function UpdateStaffType($conn, $id, $name){
    $sql ="UPDATE `staff_type` SET `Staff_Job_Name`='$name' WHERE `Staff_Job_Type`='$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=editStaffType");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

function UpdateShiftType($conn, $id, $name, $time){
    $sql ="UPDATE `room_type` SET `Shift_Name`='$name',`Shift_Time`='$time' WHERE `Shift_Id`='$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=editShiftType");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

?>