<?php
session_start();
include("connection.php");
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
      <style>
          .row{
              width: 300px;
              height: 200px;
              margin-top: 200px;
              padding: 20px;
              background-color: bisque;
          }
      </style>
  </head>
  <body>
    <!--navbar-->
        <form class="row offset-md-4">
            <div class="form control">
                <label for="username" class="form-label"><b>Username</b></label>
                <p name="username" class="form-control"><?php echo $_SESSION['username']; ?></p>
            </div>
        </form>
    -->
  </body>
</html>