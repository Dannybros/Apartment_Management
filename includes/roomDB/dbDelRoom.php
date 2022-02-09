<?php
include_once ("../dbConnect.php");
session_start();

    $roomId = $_GET['id'];

    delRoom($conn, $roomId);

    function delRoom($conn, $roomId){
        $sql = "DELETE FROM `rooms` WHERE `Room_Id`='$roomId'";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "success";
        }else{
            echo "failed";
        }
    }

?>