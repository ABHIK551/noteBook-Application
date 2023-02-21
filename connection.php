<?php
$link = mysqli_connect("localhost","root","","notebookapplication");
if(mysqli_connect_error()){
    die("ERROR unable to connect" .mysqli_connect_error());
    echo "<script>window.alert('Hi!');</script>";
}
?>