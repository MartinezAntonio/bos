<?php
require "libs/models/setLangModel.php";
include("loginCheck.php");
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="NOINDEX,NOFOLLOW,NOARCHIVE">

    <title>Booking System</title>

    <link rel="shortcut icon" href="http://bos.cr/img/logo.png" />
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link href="css/freelancer.css?v=<?php echo(rand()); ?>" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/font-awesome/fonts/Questrial-Regular.ttf" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Alerts AlertifyJs-->
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="carousel/docs/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="carousel/docs/assets/owlcarousel/assets/owl.theme.default.min.css">

    <!-- datepicker calls css-->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">

<div class="iconos-lenguages">
    <input type="hidden" name="whatLang" id="whatLang" value="<?=$_SESSION['lang']?>">
    <form method="post" action="http://bos.cr/es/" style="display: inline-block;">
        <input type="hidden" value="es" name="lang">
        <input type="hidden" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" name="currentLocation">
        <button class="zoom" id="es" <?php if($_SESSION['lang']=='es'){?> style="background-color: #18bc9c;color: white"<?php } ?>>es</button>
    </form>

    <form method="post" action="http://bos.cr/en/" style="display: inline-block;">
        <input type="hidden" value="en" name="lang">
        <input type="hidden" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" name="currentLocation">
        <button class="zoom" id="en" <?php if($_SESSION['lang']=='en'){?> style="background-color: #18bc9c;color: white"<?php } ?>>en</button>
    </form>
</div>

<!-- Header -->
<header class="div-principal" id="particles-js" style="background-image: url(<?php getHotelInfo('false','true','false');?>);">
    <div class="container" id="maincontent" tabindex="-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-text">

                    <div class="hotel-info">
                        <?php getHotelInfo('true','false','false');?>
                    </div>

                    <form method="post" action="" class="form-inline form-style" name="sentMessage" id="contactForm" onSubmit="enviarDatos(); return false">
                        <input type="hidden" id="hotelID" name="hotelID" value="<?=$_SESSION["hotelID"]?>">
                        <input type="hidden" name="start" id="CheckIn" value="<?=$_POST['CheckIn']?>">
                        <input type="hidden" name="end" id="CheckOut" value="<?=$_POST['CheckOut']?>">

                        <div class="input-daterange" id="datepicker" style="display:inline;">
                            <div class="form-group">
                                <input type="text" class="form-control-search-engine input-number" name="daterange" id="daterange" maxlength="0" autocomplete="off" required placeholder="<?=$lang['Checkin']?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control-search-engine input-number" id="adults" name="adults" min="0" max="10" placeholder="<?=$lang['adults']?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control-search-engine input-number" id="children" name="children" min="0" max="10" placeholder="<?=$lang['childrens']?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btn-check-availability" onclick="startEngine()" class="btn-check-availability"><?=$lang['btn_availability']?> <li class="fa  fa-angle-double-right"></li></button>
                        </div>
                    </form>

                    <div class="center" style="margin-top: 20px;">
                        <div class="preloader" id="engineLoader">
                            <div class="circ1"></div>
                            <div class="circ2"></div>
                            <div class="circ3"></div>
                            <div class="circ4"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>


<!-- rooms Grid Section -->
<div id="resultado" class="resultSearch">

</div>
<!-- rooms Grid Section -->

<footer id="ResultRoomsNav" class="navbar-footer navbar-result-rooms navbar-fixed-bottom hidden-footer">
    <div id="ResultRooms"></div>

    <form action="reservation.php" id="area" method="post">
        <input type="hidden" name="hotelID_" value="<?=$_SESSION['hotelID']?>" id="hotelID_">
        <input type="hidden" name="CheckIn_" id="CheckIn_">
        <input type="hidden" name="CheckOut_" id="CheckOut_">
        <input type="submit" class="book-button" value="<?=$lang['book']?>">
    </form>

</footer>


<?php include('libs/views/footer.php')?>


<?php if (isset($_GET['success'])){
    echo "<script>alertify.alert('', '<center>Your reservation has been successful!</center>');</script>";
} ?>

</body>

</html>
