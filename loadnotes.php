<?php
session_start();
include("connection.php");

//get the user_id
$user_id = $_SESSION['user_id'];
//run a query to delete empty notes
$sql = "DELETE FROM `notes` WHERE note=''";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>Failed to load query</div>";
    exit;
}
//run query to look for notes corresponding to user_id
$sql = "SELECT id,note,time FROM notes WHERE user_id='$user_id'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "<div class='alert alert-danger'>Failed to load query</div>";
    exit;
}

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $note_id = $row['id'];
        $notes = $row['note'];
        $time = $row['time'];
        $time = date("F d, Y h:i:s A",$time);
        echo "<div class='noteBox'>
        <div class='col-4 delete' style='float:left;'>
            <button class='btn btn-lg btn-danger'>delete</button>
        </div>
        <div class='noteheader' id='$note_id'>
            <div class='text'>$notes</div>
            <div class='timetext'>$time</div>
        </div>
        </div>";
    }
}else{
    echo "<div class='alert alert-danger'>There is no notes! Please create new notes.</div>";
}


//echo "<div>This is a new note</div>";
?>

<!--
<html>
    <div class='notes'>
        <div class="col-sm-5 col-md-3 delete">
            <button class='btn btn-lg btn-danger'></button>
        </div>
        <div class='noteheader' id='$note_id'>
            <div class='text'>$notes</div>
            <div class='timetext'>$time</div>
        </div>
    </div>
    
</html>
-->
