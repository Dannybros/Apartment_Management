<?php
include_once "../dbConnect.php";
session_start();
$staffId = $_GET['id'];

delStaff($conn, $staffId);

function delStaff($conn, $staffId){
    $sql = "DELETE FROM `staff` WHERE `Staff_ID`='$staffId'";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "success";
    }else{
        echo "failed";
    }
}
?>