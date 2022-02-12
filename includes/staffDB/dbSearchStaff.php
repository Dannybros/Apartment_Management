<?php
include_once ("../dbConnect.php");
if(isset($_GET['query'])){

    $search_query = $_GET['query'];

    $return_arr = array();

    $sql = "SELECT * FROM `staff` NATURAL JOIN `staff_type` NATURAL JOIN `shift` WHERE `Staff_Name` LIKE '%$search_query%'"; //WHERE `Staff_Name` LIKE '%$search_query%' OR `Salary` LIKE '%$search_query%'

    $result = mysqli_query($conn, $sql);
        
    while ($staff = mysqli_fetch_array($result)) {
        $id=$staff['Staff_ID'];
        $name=$staff['Staff_Name'];
        $job=$staff['Staff_Job_Name'];
        $shiftName=$staff['Shift_Name'];
        $shiftTime = $staff['Shift_Time'];
        $salary=$staff['Salary'];

       $return_arr[] = array(
            "id" => $id,
            "name" => $name,
            "job"=>$job,
            "shift" => "$shiftName $shiftTime",
            "salary"=>$salary
        );
    }
    echo json_encode($return_arr);
}
?>