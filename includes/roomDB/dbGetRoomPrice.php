<?php
    include_once ("../dbConnect.php");
    if (isset($_GET['roomType'])){

        $id = $_GET['roomType'];

        $query = "SELECT `Room_Type_Price` FROM  `room_type` WHERE `Room_Type_Id` = '$id'";
        $result = mysqli_query($conn, $query);
        $room_price = mysqli_fetch_assoc($result);

        echo json_encode($room_price);
    }
?>