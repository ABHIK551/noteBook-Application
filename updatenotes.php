<?php
session_start();
include("connection.php");

ini_set("error_reporting",E_STRICT);
//get the id of the note sent through Ajax
$id = $_POST['id'];

//get the content of the note
$note = $_POST['notes'];

//get the time
$time = time();

//run a query to update  notes
$sql = "UPDATE `notes` SET `note`='$note',`time`='$time' WHERE `id`='$id'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "error";
    exit;
}
?>