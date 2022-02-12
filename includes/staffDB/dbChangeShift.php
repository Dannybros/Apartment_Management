<?php
include_once ("../dbConnect.php");
session_start();

if($_POST['staff_shift_cb']){
    $shiftId = $_POST['staff_shift_cb'];
    $staffId = $_POST['staff_id'];


    $sql = "UPDATE `staff` SET `Shift_Id`='$shiftId' WHERE `Staff_ID`='$staffId'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ../../index.php?staff&success=shiftTime");
        exit();
    }else{
        header("Location: ../../index.php?staff&error");
        exit();
    }
    mysqli_close($conn);
}
?>