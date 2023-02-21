<?php
if(!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])){
    //extract auhentificator1,f2auhentificator from the cookie
    list($auhentificator1,$auhentificator2) = explode(',',$_COOKIE['rememberme']);
    $auhentificator2 = hex2bin($auhentificator2);
    $f2auhentificator = hash('sha256',$auhentificator2);
    
    $sql = "SELECT * FROM `rememberme` WHERE `auhentificator1`='$auhentificator1'";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo '<div class="alert alert-danger">failed to load query</div>';
        exit;
    }
    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">remember me process faield</div>';
        exit;
    }
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(hash_equals($row['f2auhentificator'],$f2auhentificator)){
        echo '<div class="alert alert-danger">hash equals returned false</div>';
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
            
            $sql =" INSERT INTO `rememberme`(`auhentificator1`, `f2auhentificator`, `user_id`, `expires`) VALUES ('$auhentificator1','$f2auhentificator','$user_id','$expires')";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo '<div class="alert alert-danger">failed during connection with database or there are some error in Sql!</div>';
            }
        
        $_SESSION['user_id'] = $row['user_id'];
        header('location:mainfile.php');
    }
}
?>