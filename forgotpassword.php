<?php
//<!--start session-->
session_start();
//<!--connect to the database-->
include('connection.php');
//<!--check user input-->
ini_set("error_reporting",E_STRICT);
//     <!--Define error message-->
        $EmailMissing = "<p><strong>Please enter your email address!</strong></p>";
        $InvalidEmail = "<p><strong>Please enter a valid email address!</strong></p>";
//////     <!--Get Email-->
            if(empty($_POST["forgotemail"])){
              $errors .= $EmailMissing;
              }else{
                  $email = filter_var($_POST["forgotemail"],FILTER_SANITIZE_EMAIL);
                  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                      $errors .= $InvalidEmail;
                  }
              }
                
////     <!--store errors in errors variable-->
            if($errors){
                //     <!--if there are any errors print errors-->
              $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
              echo $resultMessage;
              }else{
//////<!--no errors-->
//////     <!--Prepare variable for the queries-->
                    $email = mysqli_real_escape_string($link,$email);
//                    echo $email;
//     <!--Run queries:check if the email exists in the user table-->
                    $sql = "SELECT * FROM users WHERE email ='$email'";
                    $result = mysqli_query($link,$sql);
                    if(!$result){
                    echo '<div class="alert alert-danger">Error running the query</div>';
                    exit;
                    }
                    //         <!--Get the user Id -->
                       $count = mysqli_num_rows($result);
                        if($count != 1){
                        //     <!--if email does not exists-->
                        //         <!--print error-->
                        echo "<div class='alert alert-danger'>Email does not exists</div>";
                        exit;
                        }
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $user_id = $row['user_id'];
//                        echo $user_id;
                        //         <!--Create an unique activation code in the forgot password table-->
                        $key = bin2hex(openssl_random_pseudo_bytes(16));
                        $time = time();
                        $status = 'pending';
                        $sql = "INSERT INTO `forgotpassword`(`user_id`, `changekey`, `time`, `status`) VALUES         ('$user_id','$key','$time','$status')";
                        $result = mysqli_query($link,$sql);
                         if(!$result){
                            echo '<div class="alert alert-danger">Failed to load query and data cant be inserted.</div>';
                            }else{
                            //         <!--Send email with the link to resetpassword.php with the user id and activation code-->
                            $message = "Please click on this link to reset your account password:\n\n";
                            $message .= "http://localhost/notebookProject/resetpassword.php?user_id=$user_id&key=$key";
                            if(mail($email,'Reset your password',$message,'From:'.'abhik9570191426@gmail.com')){
                            echo "<div class='alert alert-success'>An email has been sent to $email please click on the link to reset your password</div>";
                            }
                     }
            }
?>