<?php
include_once "../dbConnect.php";
session_start();

if(isset($_POST['staff_name'])){
    $id = $_POST['staff_id'];
    $name = $_POST['staff_name'];
    $address = $_POST['staff_address'];
    $contact = $_POST['staff_contact'];
    $job = $_POST['staff_job'];
    $salary = $_POST['staff_salary'];

    $sql = "UPDATE `staff` SET `Staff_Name`='$name',`Staff_Job_Type`='$job',`Address`='$address',`Contact`='$contact', `Salary`='$salary' WHERE `Staff_ID`='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ../../index.php?staff&success=updateStaff");
        exit();
    }else{
        header("Location: ../../index.php?staff&error");
        exit();
    }
    mysqli_close($conn);
}
?>