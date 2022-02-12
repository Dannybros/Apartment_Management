<?php
include_once "../dbConnect.php";
session_start();

if($_POST['staff_name']){
    $name = $_POST['staff_name'];
    $address = $_POST['staff_address'];
    $contact = $_POST['staff_contact'];
    $job = $_POST['staff_job'];
    $salary = $_POST['staff_salary'];
    $shift = $_POST['staff_shift'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO `staff`(`Staff_Name`, `Staff_Job_Type`, `Shift_Id`, `Address`, `Contact`, `Joining_Date`, `Salary`) VALUES ('$name','$job','$shift','$address','$contact', '$date', '$salary')";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ../../index.php?staff&success=addStaff");
        exit();
    }else{
        header("Location: ../../index.php?staff&error");
        exit();
    }
    mysqli_close($conn);
}
?>