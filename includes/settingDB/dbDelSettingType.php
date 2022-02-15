<?php
include_once ("../dbConnect.php");
session_start();

    $id = $_GET['id'];
    $dt = $_GET['dt'];
    $dt_field = $_GET['dt_field'];

    $sql ="DELETE FROM `$dt` WHERE `$dt_field`='$id'";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "success";
    }else{
        echo "failed";
    }

    
    mysqli_close($conn);

?>