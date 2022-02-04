<?php
session_start();
include_once ("dbConnect.php");

if(isset($_POST['username'])){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $conPassword=$_POST['conPassword'];

    if(emptyInputField($name, $email, $username, $password, $conPassword)){
        header("Location: ../signUp.php?error=emptyField");
        exit();
    }

    if(invalidEmail($email)){
        header("Location: ../signUp.php?error=invalidEmail");
        exit();
    }

    if(!passwordMatch($password, $conPassword)){
        header("Location: ../signUp.php?error=passwordNotMatch");
        exit();
    }

    if(checkUsername($conn, $username, $email)){
        header("Location: ../signUp.php?error=usernameExists");
        exit();
    }

    createUser($conn, $name, $email, $username, $password);

}

function emptyInputField($name, $email, $username, $password, $conPassword){
    if(empty($name) || empty($email) || empty($username) || empty($password) || empty($conPassword) ){
        return true;
    }else{
        return false;
    }
}

function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function passwordMatch($password, $conPassword){
    if($password !== $conPassword){
        return false;
    }else{
        return true;
    }
}

function checkUsername($conn, $username, $email){
    $query = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $query)){
        header("Location: ../signUp.php?error=stmtFailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData)){
        return true;
    }else{
        return false;
    }

    // $result = mysqli_query($conn, $query);

    // if(mysqli_num_rows($result)>0){
    //     return true;
    // }else{
    //     return false;
    // }
}

function createUser($conn, $name, $email, $username, $password){
    $query="INSERT INTO `users`(`userName`, `userEmail`, `userUid`, `userPwd`) VALUES ('$name','$email','$username','$password')";
        
    mysqli_query($conn, $query);
    header("Location: ../login.php?register=success");
    exit();
}
?>