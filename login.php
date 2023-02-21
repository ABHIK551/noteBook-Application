<?php
//<!--start session-->
session_start();
//<!--connect to the database-->
include('connection.php');
//<!--check user input-->
//     <!--Define error message-->
//ini_set("error_reporting",E_STRICT);
$usernameMissing = "<p><strong>Username is missing please login using username</strong></p>";
$passwordMissing = "<p><strong>Password is missing please type the password inside password box</strong></p>";
$crediandial = "Username and password are not matched! Please provide valid username and password.";
    
//    $email = $_POST["loginemail"];
//$Password = $_POST["loginpassword"];
//     <!--Get username, Email, Password-->
ini_set("error_reporting",E_STRICT);
     if(empty($_POST["loginemail"])){
            $errors .= $usernameMissing;
            }else{
            $email = filter_var($_POST["loginemail"],FILTER_SANITIZE_EMAIL);
            }
            if(empty($_POST["loginpassword"])){
            $errors .= $passwordMissing;
            }else{
                $password = filter_var($_POST["loginpassword"],FILTER_SANITIZE_STRING);
            }
//     <!--store errors in errors variable-->
//     <!--if there are any errors print errors-->
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
}else{
    //<!--no errors-->
    //     <!--Prepare variable for the queries-->
    $email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);
//$password = md5($Password); //128 BITS ->32 characters
$password = hash('sha256',$password); //256 BITS ->64 characters
    $sql = "SELECT * FROM users WHERE email='$email' AND password= '$password' AND activation='activated'";
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
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        //         <!--if remember me is not cecked-->
        if(empty($_POST["rememberme"])){
            //<!--print "success"-->
            echo "success";
        }else{
            $auhentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
            $auhentificator2 = openssl_random_pseudo_bytes(20);
            
            function f1($a,$b){
                $c = $a . "," . bin2hex($b);
                return $c;
            }    
            $cookieValue = f1($auhentificator1,$auhentificator2);
            
            //store them in cookie
            setcookie("rememberme",$cookieValue,time()+1296000);
            
            //run query to store them in remember me table
            
            function f2($a){
                $b = hash('sha256',$a);
                return $b;
            }
            
            $f2auhentificator = f2($auhentificator2);
            
            //user_id
            $user_id = $_SESSION['user_id'];
            
            $expires = date('Y-m-d H:i:s',time()+1296000);
            
            $sql ="INSERT INTO `rememberme`(`auhentificator1`, `f2auhentificator`, `user_id`, `expires`) VALUES ('$auhentificator1','$f2auhentificator','$user_id','$expires')";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo '<div class="alert alert-danger">failed during connection with database or there are some error in Sql!</div>';
            }else{
                echo "success";
            }
            
        }
    }
}
}
//         <!--run query to store them in a remember me table -->
//         <!--If query is unsuccessfull-->
//            <!--Show errors-->
//        <!--If successfull-->
//            <!--print "success"-->
?>

<!--SELECT `id`, `auhentificator1`, `f2auhentificator`, `user_id`, `expires` FROM `rememberme` WHERE 1-->