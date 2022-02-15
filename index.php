<?php
    session_start();
    include_once("includes/dbConnect.php");
    
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }else{
        header("Location: login.php");
    }

    include_once("nav.php");
    include_once("sidebar.php");

    if (isset($_GET['room'])){
        include_once("dashboard/room.php");

    }else if(isset($_GET['booking'])){
        include_once "dashboard/booking.php";
        
    }else if(isset($_GET['staff'])){
        include_once "dashboard/staff.php";
        
    }else if(isset($_GET['setting'])){
        include_once "dashboard/setting.php";
        
    }else if(isset($_GET['report'])){
        include_once "dashboard/report.php";
        
    }else{
        include_once "dashboard/room.php";
    }

    include_once("footer.php");
?>

