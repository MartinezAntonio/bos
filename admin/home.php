<?php
require_once('../libs/models/config.php');
include('../session.php');
include('../functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | </title>
    <link rel="shortcut icon" href="http://bos.cr/img/logo.png" />

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!-- sidebar menu -->
        <?php include('menu.php');?>
        <!-- /sidebar menu -->

        <!-- top navigation -->
        <?php include('userInfo.php')?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="row top_tiles">
                    <?php if ($_SESSION['level']=='super user'){?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="hotels.php">
                        <div class="tile-stats">
                             <div class="icon"> <i class="fa fa-home"></i> </div>
                            <div class="count">
                                <?php
                                $link=conect::conection();
                                $contHotels=0;
                                $consulta = $link->query("select * from tb_hotels ");
                                while($row = $consulta->fetch_object()) {
                                    $contHotels++;}?>
                                <?php echo $contHotels?>
                            </div>
                            <h3>Hotels</h3>
                        </div>
                        </a>
                    </div>
                    <?php } ?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="users.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-lock"></i></div>
                            <div class="count">179</div>
                            <h3>New Sign ups</h3>
                        </div>
                        </a>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="reservations.php">
                        <div class="tile-stats">
                            <div class="icon"></div>
                            <div class="count">2</div>
                            <h3>In Process Reserves</h3>
                        </div>
                        </a>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="rooms.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-bed"></i></div>
                            <div class="count">
                                <?php
                                $link=conect::conection();
                                $contHotels=0;
                                $consulta = $link->query("select * from tb_rooms WHERE hotelID='".$_SESSION['hotelID']."' ");
                                while($row = $consulta->fetch_object()) {
                                    $contHotels++;}?>
                                <?php echo $contHotels?>
                            </div>
                            <h3>Rooms</h3>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Reservations Summary</h2>
                                <div class="clearfix"></div>
                            </div>

                           <!-- <div class="x_content">
                                <div class="container" >
                                    <div class="demo-container" style="height:300px">
                                        <div id="chart_plot_02" class="demo-placeholder"></div>
                                    </div>
                                </div>

                               <div class="col-md-3 col-sm-12 col-xs-12">

                                            <h2>Users Graph <small>External users</small></h2>

                                        <div class="x_content">
                                            <?php //calcPorcentUsers()?>
                                            <canvas id="canvasDoughnut"></canvas>
                                        </div>

                                </div>

                            </div>-->


                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include('footer.php')?>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="../vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js?v=<?php echo(rand()); ?>"></script>

</body>
</html>

