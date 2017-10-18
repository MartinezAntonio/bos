<?php
require_once('config.php');
$link=conect::conection();
$fullname=$_POST['firstname'].' '.$_POST['lastname'];
$update = $link->query("UPDATE tb_reserve SET guestName='".$fullname."',guestEmail='".$_POST['email']."',guestPhone='".$_POST['phone']."' WHERE reserveID='".$_POST['reserveID']."' ");
?>