<?php
session_start();
include("connection.php");
ini_set("error_reporting",E_STRICT);

//get the id of the note sent through Ajax
$id = $_POST['id'];
$user_id = $_SESSION['user_id'];

//run a query to delete  notes
$sql = "DELETE FROM notes WHERE id='$id' AND user_id = '$user_id'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "error";
    exit;
}
?>