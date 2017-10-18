<?php
session_start();
$currentLocation=$_POST['currentLocation'];
$_SESSION['lang']=$_POST['lang'];
if(!empty($_POST['lang'])){
    echo "<script language='javascript'>window.location='".$currentLocation."'</script>";
}else{
    echo "<script language='javascript'>window.location='http://bos.cr/'</script>";
}
?>