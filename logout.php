<?php
ini_set("error_reporting",E_STRICT);
if(isset($_SESSION['user_id']) && $_GET['logout'] == 1){
    session_destroy();  
    setcookie("rememberme","",time()-3600);
}
?>