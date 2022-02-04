<?php
include_once ("dbConnect.php");
session_start();

    $room_id = $_GET['id'];

    $sql= "UPDATE `rooms` SET `Status`='Free' WHERE `Room_Id`='$room_id'";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "success";
    }else{
        echo "failed";
    }
?>