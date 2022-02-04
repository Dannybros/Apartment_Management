<?php
    include_once("dbConnect.php");
    if (isset($_GET['query'])){

        $return_arr = array();

        $q = $_GET['query'];
        $search_qqq = explode("*", $q);
        $t = $search_qqq[0];
        $s = $search_qqq[1];

        if($t==="all"){
            $query = "SELECT * FROM `rooms` NATURAL JOIN `room_type` WHERE `Room_Name` LIKE '%$s%' OR `Status` LIKE '%$s%'";
        }else{
            $query = "SELECT * FROM `rooms` NATURAL JOIN `room_type` WHERE `Room_Type_Id` = '$t' AND (`Room_Name` LIKE '%$s%' OR `Status` LIKE '%$s%')"; 
        }
        $result = mysqli_query($conn, $query);
        
        while ($rooms = mysqli_fetch_array($result)) {
            $id=$rooms['Room_Id'];
            $name=$rooms['Room_Name'];
            $type=$rooms['Room_Type_Name'];
            $status=$rooms['Status'];
            $price=$rooms['Room_Type_Price'];

            
           $return_arr[] = array(
                "id" => $id,
                "name" => $name,
                "type"=>$type,
                "status" => $status,
                "price"=>$price
            );
        }

        echo json_encode($return_arr);
         
    }else if (isset($_GET['roomId'])){

        $id = $_GET['roomId'];
        $return_arr = array();
   
        $query = "SELECT * FROM  `rooms` NATURAL JOIN `room_type` WHERE `Room_Type_Id` = '$id' AND `Status`='Free'";
        $result = mysqli_query($conn, $query);

        while ($rooms = mysqli_fetch_array($result)) {
            $id=$rooms['Room_Id'];
            $name=$rooms['Room_Name'];
            $type_id=$rooms['Room_Type_Id'];
            $type=$rooms['Room_Type_Name'];
            $status=$rooms['Status'];
            $price=$rooms['Room_Type_Price'];

            
           $return_arr[] = array(
                "id" => $id,
                "name" => $name,
                "type_id" => $type_id,
                "type"=>$type,
                "status" => $status,
                "price"=>$price
            );
        }
   
        echo json_encode($return_arr);
    }
    else{
        echo"there is no query";
    }
?>
