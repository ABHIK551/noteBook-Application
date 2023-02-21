<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include("connection.php");
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id ='$user_id'";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo "failed to load query";
    }else{
    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">Wrong username or password</div>';
    }else{
        //     <!--else-->
//         <!--log the user in: set the session variable-->
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $username = $row['username'];
        $email = $row['email'];
    }
    }
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="myprofile.js"></script>
    <title>Profile</title>
      <style>
          html{
              overflow: hidden;
          }
          #container{
              margin-top: 100px;
              width: 100%;;
/*              margin-left: 240px;*/
              font-family: Arvo;
              color: white;
          }
          .column{
              background-color: rgba(0, 0, 0, 0.6);
              height: 260px;
             padding-top: 30px;
              padding-left: 30px;
              border-radius: 20px;
          }
          .table{
             color: white;  
          }
          .table:hover{
              color: black;
          }
          tr{
              cursor: pointer;
          }
          tr:hover{
              color:red;
/*              background-color: gray;*/
              padding: 20px;
          }
          .userDetailName{
              color: green;
              margin-left: 43px;
          }
          .userDetailEmail{
              color: green;
              margin-left: 80px;
          }
          .userDetailPassword{
              color: green;
              margin-left: 50px;
          }
          h2{
              margin-left: 14px;
             color: cornflowerblue;
          }
      </style>
  </head>
  <body>
    <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Online Notes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Help</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="mainfile.php">My Notes</a>
        </li>
      </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Logged in as <b><?php echo $username; ?></b></a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Logout</a></li>
        </ul>
    </div>
  </div>
</nav>
<!--        conatiner-->
      <div class="container" id="container">
          <div class="row">
              <div class="column col-12 col-sm-10 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-5 offset-xl-4">
                  <h2>General Account Setting : </h2>
                  <div class="table-responsive p-2">
                      <table class="form-group">
                          <tr data-bs-target="#updateUserName" data-bs-toggle="modal"  class=" form-control m-2">
                              <td><b>Useranme : </b></td>
                              <td><div class="userDetailName"><?php echo $username; ?></div></td>
                          </tr>
                          <tr data-bs-target="#updateEmail" data-bs-toggle="modal"  class=" form-control m-2">
                              <td><b>Email : </b></td>
                              <td><div class="userDetailEmail"><?php echo $email; ?></div></td>
                          </tr>
                          <tr data-bs-target="#updatePassword" data-bs-toggle="modal"  class=" form-control m-2">
                              <td><b>Password : </b></td>
                              <td class="userDetail"><div class="userDetailPassword">hidden</div></td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      
      <!--update username-->
      <form method="post" id="updateUsername">
          <div class="modal fade" id="updateUserName" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Update Username: </h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                       <div class="modal-body form-group">
                           
                           <div id="errorMessage"></div>
                           
                           <input type="text" name="ChangeUsername" id="ChangeUsername" placeholder="Username" maxlength="30" class="form-control">
                       </div> 
                       <div class="modal-footer">
                           <input type="submit" name="submit" value="submit" class="btn btn-success">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal" >Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
      
      <!--update email-->
      <form method="post" id="updateemail">
          <div class="modal fade" id="updateEmail" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Enter New Email: </h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                       <div class="modal-body form-group"> 
                           
                           <div id="errorMessage1"></div>
                           
                           <input type="email" name="ChangeEmail" id="ChangeEmail" placeholder="abc@example.com" maxlength="30" class="form-control">
                       </div> 
                       <div class="modal-footer">
                           <input type="submit" name="submit" value="submit" class="btn btn-success">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal" >Close</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
      
       <!--update password-->
      <form method="post" id="updatepassword">
          <div class="modal fade" id="updatePassword" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 id="modalLabel">Enter Current and New Password: </h4>
                         <button class="btn-close" type="button" data-bs-dismiss="modal"></button> 
                      </div>
                       <div class="modal-body form-group">
                           
                           <div id="errorMessage2"></div>
                           
                           <input type="password" name="currentPassword" id="currentpassword" autocomplete="current-password" placeholder="Your Current Password" maxlength="30" class="form-control">
                       </div> 
                      <div class="modal-body form-group">
                           <input type="password" name="ChangePassword" id="ChangePassword" autocomplete="current-password" placeholder="Choose a Password" maxlength="30" class="form-control">
                       </div> 
                      <div class="modal-body form-group">
                           <input type="password" name="ConfirmChangePassword" id="ConfirmChangePassword" autocomplete="current-password" placeholder="Confirm Password" maxlength="30" class="form-control">
                       </div> 
                       <div class="modal-footer">
                           <input type="submit" name="submit" value="submit" class="btn btn-success">
                           <button class="btn btn-white" style="border:1px solid grey;" data-bs-dismiss="modal" >Close</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>