<?php
include_once ("dbConnect.php");
session_start();
if(isset($_POST['customer_name'])){
    
    $c_id = $_POST['customer_id'];
    $c_name = $_POST['customer_name'];
    $c_email = $_POST['customer_email'];
    $c_contact = $_POST['customer_contact'];
    $c_id_card = $_POST['customer_ID_card'];

    UpdateCustomerInfo($conn, $c_id, $c_name, $c_email, $c_contact, $c_id_card);

    mysqli_close($conn);
    
}

function UpdateCustomerInfo($conn, $c_id, $c_name, $c_email, $c_contact, $c_id_card){
    $sql = "UPDATE `customer` SET `Customer_Name`='$c_name',`Customer_Contact`='$c_contact',`Customer_Email`='$c_email', `Customer_ID_Card`='$c_id_card' WHERE `Customer_ID`='$c_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:../index.php?room&success=customerInfo");
        exit();
    } else {

        header("Location:../index.php?room&error");
        exit();
    }
}
?>