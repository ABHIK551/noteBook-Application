<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
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
      <script src="myNotes.js"></script>

    <title>Online Notebook</title>
      <style>
          html{
              overflow: hidden;
          }
          #container{
              font-family: Arvo;
              margin-top: 120px;
/*               margin-left: 240px;*/
          }
          #notepad, #allNotes, #done,.delete{
              display: none;
          }
          .buttons{
              font-family: Arvo;
              margin-bottom: 60px;
              
          }
          #allNotes, #addNote, #edit{
              background-color: rgba(98, 170, 207, 0.9);
          }
          textarea{
              font-family: Arvo;
              width: 100%;
              max-width: 100%;
              font-size: 16px;
              line-height: 1.5em;
              border-left-width: 20px;
              border-color: #CA3DD9;
              color: #CA3DD9;
              background-color: #FBEFFF;
              padding: 10PX;
          }
          .noteheader{
              font-family: Arvo;
              border: 1px solid grey;
              border-radius: 10px;
              margin-bottom: 10px;
              cursor: pointer;
              background: linear-gradient(#FFFFFF,#ECEAE7);
              padding: 0 10px;
          }
          .text{
              font-size: 20px;
              overflow: hidden;
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent2">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Help</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">My Notes</a>
        </li>
      </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Logged in as <b><?php echo $_SESSION['username']; ?></b></a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php?logout=1">Logout</a></li>
        </ul>
    </div>
  </div>
</nav>
<!--        conatiner-->
      <div class="container" id="container">
          <!--Alert message-->
          <div class="row">
              <div class="column col-sm-8 col-md-6 offset-sm-2 offset-md-3">
                  <div id="alert" class="alert alert-danger collapse"><a class="close" data-bs-dismiss="alert">&times;</a><p id="alertConent"></p></div>
                  <div class="buttons">
                      <button id="addNote" type="button" class="btn  btn-lg float-start">Add Notes</button>
                      <button id="edit" type="button" class="btn  btn-lg float-end">Edit</button>
                      <button id="done" type="button" class="btn btn-success btn-lg float-end">Done</button>
                      <button id="allNotes" type="button" class="btn  btn-lg float-start">All Notes</button>
                  </div>
                  
                  <div id="notepad">
                      <textarea rows="10"></textarea>
                  </div>
                  
                  <div id="notes" class="notes">
                  <!--Ajax call to a php file-->
                  </div>
              </div>
          </div>
      </div>
      <!--footer-->
      <div class="footer">
          <div class="container">
              <p>DevelopmentIsland.com Copyright &copy; 2015-<?php $today= date("Y"); echo $today; ?></p>
          </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->
<!--
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="abc.js"></script>
-->
    <!-- Option 1: Bootstrap Bundle with Popper -->
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>