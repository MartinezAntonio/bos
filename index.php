<?php
session_start();
if(!empty($_POST['Api_key'])){
    $_SESSION['Api_key']=$_POST['Api_key'];
}
if(!empty($_POST['hotelID'])){
    $_SESSION['hotelID']=$_POST['hotelID'];
}

if(!empty($_SESSION['hotelID']) and $_SESSION['Api_key']=='59e0dd412hdrtgrdyhrtf51c*'){
    require_once('libs/views/homePageView.php');
}else{
    $_SESSION['Api_key']='';
    $_SESSION['hotelID']='';
    session_destroy();
    require_once('libs/views/indexView.php');
}
session_set_cookie_params(7200); // Set session cookie duration to 1 hour
?>