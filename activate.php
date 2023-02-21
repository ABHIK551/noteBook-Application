<?php
//<!--The user is re-directed to this file after clicking the activation link-->
//<!--Signup Link contains two GET parameters: email and activation key-->
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Form</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <style>
        .contactForm{
            border: 1px solid #7c73f6;
            margin-top: 50px;
            border-radius: 15px;
        }
    </style>
<body>
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-10 offset-sm-1 contactForm">
            <h1>Account activation:</h1>
            <?php
            //<!--If activation key and email is missing show  an error-->
                if(!isset($_GET["email"]) || !isset($_GET["key"])){
                    echo "<div class='alert alert-danger'>There was error. Please click on the activation link you recieved by email.</div>";
                    exit;
                }
                //<!--else-->
                //    <!--store them in two variables-->
                $email = $_GET["email"];
                $Key = $_GET["key"];
                //    <!--Prepare variables for the query-->
                $email = mysqli_real_escape_string($link,$email);
                $Key = mysqli_real_escape_string($link,$Key);
                //    <!--Run query: set activation,field to "activated" for the provided email-->
                $sql = "UPDATE users SET activation = 'activated' WHERE (email='$email' AND activation='$Key') LIMIT 1";
                           $result = mysqli_query($link,$sql);
                //    <!--if the query is successfull, show success messege and invite user to login-->
                if(mysqli_affected_rows($link) == 1){
                    echo "<div class='alert alert-success'>Your account activated successfully.</div>";
                     echo '<a href="index.php" class="btn btn-lg btn-success">Login</a>';
                }else{
                //    <!--else-->
            //        <!--show error messege-->
                echo '<div class="alert alert-danger">Your account could not be logged in please try again later.</div>';
                }
            ?>
        </div>
    </div>
   
</div>
  </body>
</html>
