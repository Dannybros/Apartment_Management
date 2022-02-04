<?php
include_once ("dbConnect.php");
session_start();

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE userUid ='$username' AND userPwd ='$password'";

    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username']=$user['userUid'];

        header("Location: ../index.php?room");
    }else{
        header("Location: ../login.php?error=usernamePw_incorrect");
        exit();
    }
}
?>