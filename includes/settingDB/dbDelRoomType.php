<?php
include_once ("../dbConnect.php");
session_start();

    $id = $_GET['id'];

    $sql ="DELETE FROM `room_type` WHERE `Room_Type_Id`='$id'";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "success";
    }else{
        echo "failed";
    }

    
    mysqli_close($conn);

?>