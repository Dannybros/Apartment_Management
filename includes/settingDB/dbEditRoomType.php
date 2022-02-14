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


function UpdateRoomType($conn, $id, $name, $price){
    $sql ="UPDATE `room_type` SET `Room_Type_Name`='$name',`Room_Type_Price`='$price' WHERE `Room_Type_Id`='$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location:../../index.php?setting&success=roomType");
        exit();
    } else {

        header("Location:../../index.php?setting&error");
        exit();
    }
}

?>