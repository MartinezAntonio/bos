<?php
require_once('libs/models/config.php');
include('userClass.php');

$userClass = new userClass();
$errorMsgReg='';
$errorMsgLogin='';

/* Login Form Facebook*/
if (!empty($_GET['facebookID'])){

    $loginType=0;
    $email=$_GET['email'];
    $name=$_GET['name'];
    $password=$_GET['facebookID'];
    $lastName=$_GET['lastName'];
    $firstName=$_GET['firstName'];
    $facebookID=$_GET['facebookID'];
    $creationDate=date('Y-m-d');
    $hotelID=0;
    $userID=0;
    $user_id_select=0;

    if(strlen(trim($email))>1 && strlen(trim($password))>1){
        $link=conect::conection();
        //Compruebo si el usuario existe en la BD
        $select = $link->query("SELECT * FROM tb_user WHERE email='".$email."' AND password='".$password."' ");
        while($row = $select->fetch_object()) {
            $user_id_select=$row->userID;
        }
        //Si el usuario existe iniciar sesion
        if ($user_id_select != ''){
            $userID=$userClass->userLogin($email,$password);
        }else{
            //De lo contrario registrarlo
            $userID=$userClass->userRegistration($password,$facebookID,$email,$name,$lastName,$firstName,$hotelID,$creationDate);
        }
        //Si alguna de las funciones (login o registro) responden, redireccionar al home e iniciar sesion
        if($userID){
            echo $response=$userID;
            $url=BASE_URL.'home.php';
            header("Location: $url"); // Page redirecting to home.php
        }else{
            echo $response="error";
        }

    }
}

/*----------------------*/

/* Login Form */
if (!empty($_POST['loginSubmit'])){

    $username= $_POST['username'];
    $password = md5($_POST['password']);//password encriptado

    if(strlen(trim($username))>1 && strlen(trim($password))>1){

        $userID=$userClass->userLogin($username,$password);

        if($userID){
            //si el login se hace desde booking/admin/index.php, redireccionar al home
            if (isset($_POST['adminLogin'])){
                header('location: http://bos.cr/admin/home.php');
            }
            echo $response=$userID;
        }else{
            echo $response="error";
        }
    }
}

/*----------------------*/



/* Signup Form */
if (!empty($_POST['signupSubmit'])){

    $firstName=$_POST['nameReg'];
    $name=$_POST['nameReg'];
    $lastName=$_POST['lastName'];
    $email=$_POST['emailReg'];
    $password=$_POST['passwordReg'];
    $creationDate=date('Y-m-d');

    $facebookID=0;
    $hotelID=0;

    $userID=$userClass->userRegistration($password,$facebookID,$email,$name,$lastName,$firstName,$hotelID,$creationDate);
    if($userID){
        echo $response="success";
    }else{
        echo $response="error";
    }

}
?>