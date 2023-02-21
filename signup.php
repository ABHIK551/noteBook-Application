<?php
//<!--start session-->
session_start();
//<!--connect to the database-->
    include('connection.php');
//<!--check user input-->
//     <!--Define error message-->
        $UsernameMissing = "<p><strong>Please enter username!</strong></p>";
        $EmailMissing = "<p><strong>Please enter your email address!</strong></p>";
        $InvalidEmail = "<p><strong>Please enter a valid email address!</strong></p>";
        $InvalidPassword = "<p><strong>Your password should be atleast 6characters long and include 1 capital letter and one number</strong></p>";
        $PasswordMissing = "<p><strong>Please enter a password!</strong></p>";
        $PasswordMissing2 = "<p><strong>Please confirm your password!</strong></p>";
        $Passwordunmatched = "<p><strong>Password are not matched</strong></p>";

//     <!--Get username, Email, Password, password2-->
                ini_set("error_reporting",E_STRICT);
                      $Username = $_POST["username"];
                      $Email = $_POST["email"];
                      $Password = $_POST["password"];
                      $Password2 = $_POST["confirmPassword"];

                          if(empty($Username)){
                              $errors .= $UsernameMissing;
                          }else{
                              $Username = filter_var($Username,FILTER_SANITIZE_STRING);
                          }
                          if(empty($Email)){
                              $errors .= $EmailMissing;
                          }else{
                              $Email = filter_var($Email,FILTER_SANITIZE_EMAIL);
                              if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
                                  $errors .= $InvalidEmail;
                              }
                          }
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
                          
//     <!--store errors in errors variable-->
//     <!--if there are any errors print errors-->
                          if($errors){
                              $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
                              echo $resultMessage;
                          }
                              //<!--no errors-->

//     <!--Prepare variable for the queries-->
$username = mysqli_real_escape_string($link,$Username);
$email = mysqli_real_escape_string($link,$Email);
$password = mysqli_real_escape_string($link,$Password);
//$password = md5($Password); //128 BITS ->32 characters
$password = hash('sha256',$Password); //256 BITS ->64 characters
//     <!--if username exists in the user table print error-->
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>Error running the query</div>";
//    echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
   exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo "<div class='alert alert-danger'>Username already exists</div>";
   exit;
}
//     <!--else-->
//           <!--if email exists in the user table print error-->

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>Error running the query</div>";
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo "<div class='alert alert-danger'>Email already exists</div>";
    exit;
}

////           <!--else-->
////                 <!--creae a unique activation code-->
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
//
////byte:unit of data = 8 bits
////bit: 0 or 1
////16 bytes = 16*8= 128 bits
////2*2*2*2*2*2*2.....*2
//
////                 <!--Insert user details and activation code in the user table-->
//
//$sql = "INSERT INTO `users`(`username`, `email`, `password`, `activation`) VALUES ('$Username','$Email','$Password','$actiationKey')";
if(!$errors){
    $sql = "INSERT INTO `users`(`username`, `email`, `password`, `activation`) VALUES ('$username','$email','$password','$activationKey')";
    $result = mysqli_query($link,$sql);
    if(!$result){
    echo "<div class='alert alert-danger'>There was and error during inserting values into the database</div>";
    exit;
}
//                 <!--Send the user email with the link to activate.php with tehere email and activation code-->
    $message = "Please click on this link to activate your account:\n\n";
    $message .= "http://localhost/notebookProject/activate.php?email=".urlencode($email)."&key=$activationKey";
    if(mail($email,'confirm your Registration',$message,'From:'.'abhik9570191426@gmail.com')){
    echo "<div class='alert alert-success'>Thank you for registering the email has been sent already to $email please click on the link to activate your id</div>";
}else{echo "<div class='alert alert-success'>Failed to send mail: </div>";}
}
  
?>