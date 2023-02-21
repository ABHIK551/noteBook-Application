<?php
session_start();
include('connection.php');
include('logout.php');
include('rememberme.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arvo">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Online Notebook</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="index.js">

    </script>
  </head>
  <body>
    <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Online Notes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Help</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Contact Us</a>
        </li>
      </ul>
        <button class="btn btn-outline-success" id="login" data-bs-target="#loging" data-bs-toggle="modal">Login</button>
    </div>
  </div>
</nav>
    <!--Jumbotron-->
      <div class="jumbotron" id="myContainer">
              <h1>Online Notes App</h1>
              <p>Your Notes with you wherevever you go.<p>
              <p>Easy to use, protect all your notes!<p>
          <button type="button" class="btn btn-lg signup" data-bs-target="#signup" data-bs-toggle="modal">Sign up-It's free</button>
      </div>
        <!--SignUp Form-->
      <form method="post" id="signupForm">
          <div class="modal fade" id="signup" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Sign up today and Start using our Online Notes App!</h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                      <?php
//                      ini_set("error_reporting",E_STRICT);
//                      $Username = $_POST["Username"];
//                      $Email = $_POST["email"];
//                      $Password = $_POST["password"];
//                      
//                      $UsernameMissing = "<p>Please enter username!</p>";
//                      $EmailMissing = "<p>Please enter your email address!</p>";
//                      $PasswordMissing = "<p>Please enter a password!</p>";
//                      
//                      if($_POST["submit"]){
//                          if(!$Username){
//                              $errors .= $UsernameMissing;
//                          }
//                          if(!$Email){
//                              $errors .= $EmailMissing;
//                          }
//                          if(!$Password){
//                              $errors .= $PasswordMissing;
//                          }
//                          
//                          if($errors){
//                              $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
//                              echo $resultMessage;
//                          }else{
//                              $resultMessage = '<div class="alert alert-success">Signed up successfully.</div>';
//                              echo $resultMessage;
//                          }
//                      }
                      ?>
                       <div class="modal-body form-group">
                           
                           <div id="signUpMessage">
                           </div>
                           
                           <input type="text" name="username" placeholder="Username" autocomplete="username" maxlength="30" class="form-control">
                       </div>
                      
                       <div class="modal-body form-group">
                           <input type="email" name="email" autocomplete="email" placeholder="Email Address"  maxlength="60" class="form-control">
                       </div>
                      
                       <div class="modal-body form-group">
                           <input type="password" name="password" autocomplete="current-password" placeholder="Choose a password" maxlength="16" class="form-control">
                       </div>
                      
                       <div class="modal-body form-group">
                           <input type="password" name="confirmPassword" placeholder="Confirm password" maxlength="16" autocomplete="current-password" class="form-control">
                       </div>
                      
                       <div class="modal-footer">
                           <input type="submit" name="submit" value="SignUp" class="btn btn-success" id="signupBtn">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
      
       <!--Login Form-->
       <form method="post" id="logingForm">
          <div class="modal fade" id="loging" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Login:</h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                       <div class="modal-body form-group">
                           
                           <div id="loginMessage">
                           </div>
                           
                           <input type="email" name="loginemail" autocomplete="username" placeholder="Email" maxlength="30" class="form-control">
                       </div>
                       <div class="modal-body form-group">
                           <input type="password" name="loginpassword" autocomplete="current-password"  placeholder="Type password" maxlength="16" class="form-control">
                       </div>
                      <div class="form-group checkbox">
                          <label for="rememberme" class="form-group-label">
                              <input type="checkbox" name="rememberme" id="rememberme">
                              Remember me
                          </label>
                          <a  href="#forgotpass" data-bs-toggle="modal" id="forgotPassword" data-bs-dismiss="modal">Forgot Password?</a>
                      </div>
                       <div class="modal-footer">
                           <input type="submit" name="submit" value="register" id="register" class="btn">
                           <input type="submit" name="submit" value="login" class="btn btn-success">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
      
        <!--Forgot Password Form-->
      <form method="post" id="forgotPass">
          <div class="modal fade" id="forgotpass" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Forgot Password!</h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                       <div class="modal-body form-group">
                           
                           <div id="forgotpassMessage">
                           </div>
                           
                           <input type="email" name="forgotemail" autocomplete="username" placeholder="abc@example.com" maxlength="30" class="form-control">
                       </div>
                       <div class="modal-footer">
                           <input type="submit" name="sumEmail" value="submit Email" class="btn btn-success">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
      <!--footer-->
      <div class="footer">
          <div class="container">
              <p>DevelopmentIsland.com Copyright &copy; 2015-<?php $today= date("Y"); echo $today; ?></p>
          </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
<!--    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
  </body>
</html>