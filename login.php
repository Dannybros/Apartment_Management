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
            if($_GET['error'] == "usernamePw_incorrect"){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Username or Password is incorrect!
                    </div>
                ';
            }
        }
        if(isset($_GET['register'])){
            if($_GET['register'] == "success"){
                echo'
                    <div class="alert alert-success" role="alert">
                        Registered Success!
                    </div>
                ';
            }
        }
       
    ?>
    
    <form method="POST" action="includes/dbLogin.php" class="login_Form p-4">
        <h2>Log In</h2>
        <div class="login_box container">
            <input type="text" class="col-md-12 p-2" name="username" placeholder="Username...">
            <input type="password" class="col-md-12 p-2" name="password" placeholder="Password...">
            <button type="submit" class="p-2 col-md-12 submit_button" name="submit">Login</button>
            <a href="signUp.php">Register the Account</a>
        </div>
    </form>
</div>

<?php
include_once("footer.php");
?>