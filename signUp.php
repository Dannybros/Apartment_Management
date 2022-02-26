<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <title>Log In</title>
</head>
<body>

<div class="login__page">
    <?php
        if(isset($_GET['error'])){
            if($_GET['error'] == "emptyField"){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Please fill in all the fields!
                    </div>
                ';
            }else if ($_GET['error'] == "invalidEmail"){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Email is Invalid!
                    </div>
                ';
            }else if ($_GET['error'] == "passwordNotMatch"){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Password does not match!
                    </div>
                ';
            }else if ($_GET['error'] == "usernameExists"){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Username already taken!
                    </div>
                ';
            }else{
                echo'
                    <div class="alert alert-danger" role="alert">
                       Something went wrong!!
                    </div>
                ';
            }
        }
    ?>
    
    <form  method="POST" action="includes/dbSignUp.php" class="login_Form p-4">
        <h2>Sign Up</h2>
        <div class="login_box container">
            <input type="text" class="col-md-12 p-2" name="name" placeholder="Full Name...">
            <input type="email" class="col-md-12 p-2" name="email" placeholder="Email...">
            <input type="text" class="col-md-12 p-2" name="username" placeholder="Username...">
            <input type="password" class="col-md-12 p-2" name="password" placeholder="Password...">
            <input type="password" class="col-md-12 p-2" name="conPassword" placeholder="Confirm Password...">
            <button type="submit" class="p-2 col-md-12 submit_button" id="submit" name="submit">Register</button>
            <a href="login.php">Go to Log In Page</a>
        </div>
    </form>
</div>
<?php
include_once("footer.php");
?>