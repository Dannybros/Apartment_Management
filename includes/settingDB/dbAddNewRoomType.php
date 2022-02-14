<?php
include_once ("../dbConnect.php");
session_start();

if(isset($_POST['roomType__name'])){
    $name = $_POST['roomType__name'];
    $price = $_POST['roomType__price'];

    AddRoomType($conn, $name, $price);

    mysqli_close($conn);
}


function AddRoomType($conn,$name, $price){
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

?>