<?php
    session_start();
    include('connection.php');
            //<!--else-->
            //    <!--store them in two variables-->
        $user_id = $_POST['user_id'];
        $Key = $_POST['key'];
        $time = time() - 86400;
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
            echo '<div class="alert alert-danger">Link expired or invalid user_id or key !'.$user_id.'</div>';
            exit;
        }

        ini_set("error_reporting",E_STRICT);
        $InvalidPassword = "<p><strong>Your password should be atleast 6characters long and include 1 capital letter and one number</strong></p>";
        $PasswordMissing = "<p><strong>Please enter a password!</strong></p>";
        $PasswordMissing2 = "<p><strong>Please confirm your password!</strong></p>";
        $Passwordunmatched = "<p><strong>Password are not matched</strong></p>";

         $Password = $_POST['newPassword'];
         $Password2 = $_POST['confirmPassword'];

        if(empty($Password)){
              $errors .= $PasswordMissing;
          }elseif(!(strlen($Password)>6 and preg_match('/[A-Z]/',$Password) and preg_match('/[0-9]/',$Password)))
          {
              $errors .= $InvalidPassword;
          }else{
              $Password = filter_var($Password,FILTER_SANITIZE_STRING);
              if(empty($Password2)){
                  $errors .= $PasswordMissing2;
              }else{
                  $Password2 = filter_var($Password2,FILTER_SANITIZE_STRING);
                  if($Password !== $Password2){
                      $errors .= $Passwordunmatched;
                  }
              }
          }

            if($errors){
                $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
                echo $resultMessage;
                exit;
            }

            $Password = mysqli_real_escape_string($link,$Password);
            $Password = hash('sha256',$Password);
            $user_id = mysqli_real_escape_string($link,$user_id);

            $sql = "UPDATE `users` SET `password`='$Password' WHERE `user_id`='$user_id'";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo '<div class="alert alert-danger">There was a problem storing a new password ! </div>';
//                    echo mysqli_error($link);
                exit;
            }
                $sql = "UPDATE `forgotpassword` SET `status`='Used'  WHERE `user_id`='$user_id' AND `changekey`='$Key' AND `time`>'$time'";
                $result = mysqli_query($link,$sql);
                if(!$result){
                    echo '<div class="alert alert-danger">There was some problem try again later ! </div>';
//                    echo mysqli_error($link);
                }else{
                echo '<div class="alert alert-success">Your Password changed successfully</div>';
        }                
?>