<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reset Password Form</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <style>
        .resetPassForm{
            border: 1px solid #7c73f6;
            margin: 200px auto;
            border-radius: 15px;
            font-family: Arvo, serif;
        }
    </style>
<body>
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-10 offset-sm-1 resetPassForm">
            <h1>Enter New Password:</h1>
            <div id="resultMessage"></div>
<!--
            <div class="form-group">
                <label for="newPassword" class="form-label"><b your>Enter your New Password : </b></label>
                <input type="password" name="newPassword" maxlength="30" autocomplete="current-password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="confirmPassword"  class="form-label"><b>Re-Enter Password : </b></label>
                <input type="password" name="confirmPassword" maxlength="30" autocomplete="current-password" class="form-control mb-2" placeholder="Re-Enter Password">
            </div>
            <input type="submit" name="submit" value="Reset Password" class="btn btn-lg btn-success">
-->
            <?php
            //<!--If activation key and email is missing show  an error-->
                if(!isset($_GET['user_id']) || !isset($_GET['key'])){
                    echo "<div class='alert alert-danger'>There was error. Please click on the link you recieved by email 1.</div>";
                    exit;
                }
                //<!--else-->
                //    <!--store them in two variables-->
                $user_id = $_GET['user_id'];
                $Key = $_GET['key'];
                $time = time() - 86400;
//                print_r($user_id);
//                print_r($Key);
                //    <!--Prepare variables for the query-->
                $user_id = mysqli_real_escape_string($link,$user_id);
                $Key = mysqli_real_escape_string($link,$Key);
                //    <!--Run query: set activation,field to "activated" for the provided email-->
                $sql = "Select user_id FROM forgotpassword WHERE changekey = '$Key' AND user_id='$user_id' AND time > $time AND status ='pending'";
                $result = mysqli_query($link,$sql);
                if(!$result){
                    echo '<div class="alert alert-danger">failed to load query</div>';
                    exit;
                }
                $count = mysqli_num_rows($result);
                if($count !== 1){
                    echo '<div class="alert alert-danger">Link expired or invalid user_id or key !</div>';
                    exit;
                }
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                echo "<form method='post' id='resetForm'>
                        <input type='hidden' name='key' value='$Key'>
                        <input type='hidden' name='user_id' value='$user_id'>
                        <div class='form-group'>
                        <label for='newPassword' class='form-label'><b your>Enter your New Password : </b></label>
                        <input type='password' name='newPassword' maxlength='30' autocomplete='current-password' class='form-control' placeholder='Enter Password'>
                        </div>
                        <div class='form-group'>
                            <label for='confirmPassword'  class='form-label'><b>Re-Enter Password : </b></label>
                            <input type='password' name='confirmPassword' maxlength='30' autocomplete='current-password' class='form-control mb-2' placeholder='Re-Enter Password'>
                        </div>
                        <input type='submit' name='resetPass' value='Reset Password' class='btn btn-lg btn-success mb-2'>
                     </form>";
            ?>
        </div>
    </div>
</div>
    <script>
         $("#resetForm").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
    
      // Send them to login.php using AJAX
    $.ajax({
        url:"storeresetpassword.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#resultMessage").html(data);
        },error:function(){
            $("#resultMessage").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
        });
        });
    </script>
  </body>
</html>
