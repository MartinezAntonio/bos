<?php
//include('../config.php');
$_SESSION['userID']='';
session_destroy();
if(empty($_SESSION['userID'])){
        $url='http://bos.cr/admin/';
    header("Location: $url");

}
?>

