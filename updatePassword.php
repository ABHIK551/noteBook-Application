<?php
session_start();
include("connection.php");
ini_set("error_reporting",E_STRICT);

//get user id
$user_id = $_SESSION['user_id'];

//get username sent through ajax
$currentPassword = $_POST['currentPassword'];
$currentPassword = hash('sha256',$currentPassword);

$newPassword = $_POST['ChangePassword'];
$newPassword = hash('sha256',$newPassword);
//print_r($user_id);
//print_r($username);
//run the query to update username
$sql = "UPDATE users SET password = '$newPassword' WHERE password='$currentPassword' AND user_id='$user_id'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>There is some issue during updation of username</div>";
    exit;
}

?>