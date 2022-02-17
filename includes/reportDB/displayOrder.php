<?php 
    // Include Connection File 
    require('../dbConnect.php');

    if(isset($_GET["order"])) {
        $order  = explode(",",$_GET["order"]);
        for($i=0; $i < count($order);$i++) {
            $sql = "UPDATE booking SET Display_Order='" . $i . "' WHERE Booking_Id=". $order[$i];		
            mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
        }
    }
?>