<?php
require_once('../libs/models/config.php');
include("../loginCheck.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrator | </title>
    <link rel="shortcut icon" href="http://bos.cr/img/logo.png" />

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/freelancer.css" rel="stylesheet">


</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post" name="loginForm" id="loginForm" action="" onSubmit="enviarDatosFormLogin('../loginCheck.php'); return false">
                    <input type="hidden" name="adminLogin" value="true">

                    <img class="img-login-admin" src="../img/admin.png">

                    <div>
                        <input type="text" class="form-control input-login-form" value="" id="username" name="username" required autocomplete="off" placeholder="Email">
                    </div>

                    <div>
                        <input type="password" class="form-control input-login-form" value="" id="password" name="password" required autocomplete="off" placeholder="Password">
                    </div>

                    <!-- Loader -->
                    <div class="center" style="margin-top: 25px;">
                        <div class="preloader" id="loginLoader">
                            <div class="circ1"></div>
                            <div class="circ2"></div>
                            <div class="circ3"></div>
                            <div class="circ4"></div>
                        </div>
                    </div>
                    <!-- Loader -->

                    <div>
                        <input type="submit" class="login-button-admin" value="Log In" name="loginSubmit">
                        <div id="accountRecovery1">
                            <p><a href="#">¿Forgot your account?</a></p>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="errorMsg" id="errorMsgLogin"></div>

                        <div class="clearfix"></div>
                        <br/>
                        <div>
                            <p>ADMINISTRATOR</p>
                        </div>
                    </div>

                </form>


            </section>
        </div>
    </div>
</div>

<script type="text/javascript" src="../js/custom.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>

</body>
</html>
