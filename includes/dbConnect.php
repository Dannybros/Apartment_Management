<?php
    $host="localhost";
    $user="root";
    $password="";
    $dbname="apartment_db";
    global $conn;
    $conn=mysqli_connect($host, $user, $password, $dbname);
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
?>