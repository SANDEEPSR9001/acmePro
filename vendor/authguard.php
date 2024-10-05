<?php
//check whether login is success or not
session_start();

if(!isset($_SESSION["login_status"])){
    echo "Illegal attempt by skipping login";
    die;
}

if($_SESSION["login_status"]==false){
    echo "Unauthorized Access";
    die;
}
if($_SESSION['usertype']!="Vendor"){
    echo "Forbidden Access";
    die;
}

?>