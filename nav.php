<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link href="css/dashboard.css" type="text/css" rel="stylesheet">
    <link href="css/reservation.css" type="text/css" rel="stylesheet">
    <link href="css/room.css" type="text/css" rel="stylesheet">
    <title>Apartment System</title>
</head>
<body style="box-sizing: content-box;">
    <nav class="nav justify-content-between ">
        <a class="navbar-brand" href="#"> <span>Apartment &nbsp; </span> Management System</a>
        <button data-toggle="modal" data-target="#exampleModal" ><i class="fas fa-sign-out-alt"></i></button>
    </nav>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sign Out Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really wish to log out from this account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="window.location.href='logout.php'">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>