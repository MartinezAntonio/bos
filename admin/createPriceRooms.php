<?php
require_once('../libs/models/config.php');
$link=conect::conection();
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

    <title>Prices per season | </title>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!--alertify-->
    <script src="../alertify/alertify.min.js"></script>
    <link rel="stylesheet" href="../alertify/css/alertify.min.css"/>
    <link rel="stylesheet" href="../alertify/css/themes/default.min.css"/>
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- datepicker calls css-->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <?php include('alerts.php') ?>
    <?php deleteAddOns($_GET['deleteAddOns']) ?>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- sidebar menu -->
        <?php include('menu.php'); ?>
        <!-- /sidebar menu -->

        <!-- top navigation -->
        <?php include('userInfo.php') ?>
        <!-- /top navigation -->

        <?php updateAddOns($_POST['updateaddonsID']) ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Set Rooms Rates</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <?php if ($_SESSION['level'] == 'super user') { ?>
                                    <form action="" name="hotel" method="post">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <b>Hotel:</b>
                                            <select id="hotel" type="text" name="hotelID" title="hotel"
                                                    required="required"
                                                    class="optional form-control col-md-7 col-xs-12">
                                                <?php getHotels() ?>
                                            </select>
                                        </div>
                                        <br>
                                        <button id="send" type="submit" class="btn btn-success">Search</button>
                                    </form>
                                    <hr>
                                    <?php nameHotels($_POST['hotelID']) ?>
                                <?php } else {$_POST['hotelID'] = $_SESSION['hotelID'];}?>
                            </div>

                            <?php if ($_POST['hotelID']>0){?>
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" name="codigo_b">
                                <input type="hidden" name="permiso" value="S">
                                <input type="hidden" name="hotelID" value="<?=$_POST['hotelID'] ?>">
                                <input type="hidden" name="datepicker1" id="date1">
                                <input type="hidden" name="datepicker2" id="date2">

                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <b>Date ranges:</b>
                                        <div class="input-daterange" id="datepicker" style="display:inline;">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-number" name="daterange_rates" id="daterange_rates" maxlength="0" autocomplete="off" required placeholder="Dates" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <b>Room:</b>
                                        <select id="hotel" type="text" name="roomID" title="hotel"
                                                required="required"
                                                class="optional form-control col-md-7 col-xs-12">
                                            <?php getRooms($_POST['hotelID']) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <b>Price:</b>
                                        <input type="text" name="price" class="form-control" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <b>Rooms available:</b>
                                        <input type="number" name="available" class="form-control" placeholder="" autocomplete="off" required min="0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <b>Enable:</b><br>
                                        <input type="checkbox" value="Y" name="enable" class="js-switch" checked data-switchery="true" style="display: none;" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <button id="send" type="submit" class="btn btn-success" style="width: 100%">Submit</button>
                                    </div>
                                </div>


                            </form>
                            <?php } ?>


                            <?php if ($_POST['permiso']=='S'){
                                $link=conect::conection();
                                $datepicker1 = date_create($_POST["datepicker1"]);
                                  $_POST["datepicker1"]=date_format($datepicker1, 'Y-m-d');

                                $datepicker2 = date_create($_POST["datepicker2"]);
                                 $_POST["datepicker2"]=date_format($datepicker2, 'Y-m-d');


                            //for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i++) {
                            for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {

                                $exists ='N';
                                $consulta = $link->query("select * from tb_roomRates WHERE hotelID='".$_POST['hotelID']."' and roomID='".$_POST['roomID']."' and dateNight='".$i."'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                                while($row = $consulta->fetch_object()) {
                                    $exists ='Y';
                                }
                                if ($_POST['enable']==''){$_POST['enable']='N';}
                                if ($exists=='Y'){
                                    $update = $link->query("UPDATE tb_roomRates SET price ='".$_POST['price']."',enable ='".$_POST['enable']."',available ='".$_POST['available']."'WHERE hotelID='".$_POST['hotelID']."' and roomID='".$_POST['roomID']."' and dateNight='".$i."'  ")or die ("Couldn't execute query: ".mysqli_error($this->db));
                                } else {
                                    $insert = $link->query("INSERT INTO tb_roomRates (hotelID,roomID,dateNight,price,enable,available) VALUES('".$_POST['hotelID']."','".$_POST['roomID']."','$i','".$_POST['price']."','Y','".$_POST['available']."')")or die ("Couldn't execute query: ".mysqli_error($this->db));
                                }

                            }

                                alerts('setRates','success');
                             } ?>
                        </div>

                    </div>
                </div>



            </div>
        </div>
        <!-- /page content -->


        <!-- footer content -->
        <?php include('footer.php') ?>
        <!-- /footer content -->
    </div>
</div>


<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../js/custom.js"></script>

<script>
    /*DATERANGEPICKER*/
    $('input[name="daterange_rates"]').daterangepicker({
    opens: 'center',
    autoApply: true,
    autoUpdateInput: false,
    locale: {
    format: 'YYYY-MM-DD'
    },
    minDate: moment(),
    startDate: moment(),
    endDate: moment().subtract(-1, 'days')
    },
    function(start, end) {
    $('#daterange_rates').attr("placeholder", start.format("MMM DD")+" to "+end.format("MMM DD"));
    $('#date1').val(start.format('YYYY-MM-DD'));
    $('#date2').val(end.format('YYYY-MM-DD'));
    });
</script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>
</body>
</html>