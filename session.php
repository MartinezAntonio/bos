<?php
if(!empty($_SESSION['userID'])){
    $session_user_id=$_SESSION['userID'];
    include('userClass.php');
    $userClass = new userClass();
}
if(empty($_SESSION['userID'])){
    header("Location: http://bos.cr/admin/");
}
?>
