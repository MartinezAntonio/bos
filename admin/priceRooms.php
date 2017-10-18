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
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <?php include('alerts.php') ?>



</head>

<body class="nav-md">
<?php
if ($_POST["guardar"] == 'S') {

    for ($i = 1; $i < $_POST["contador"]; $i++) {
        $exists = 'N';
        $consulta = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $_POST['roomID'] . "' and dateNight='" . $_POST['date_' . $i] . "'");
        while ($row = $consulta->fetch_object()) {
            $exists = 'Y';
        }
        if ($_POST['enable_' . $i] == '') {
            $_POST['enable_' . $i]='N';
        }
        if ($exists == 'Y') {
            $update = $link->query("UPDATE tb_roomRates SET price ='" . $_POST['price_' . $i] . "',enable ='" . $_POST['enable_' . $i] . "',available ='" . $_POST['available_' . $i] . "'WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $_POST['roomID'] . "' and dateNight='" . $_POST['date_' . $i] . "'  ");
        } else {
            $insert = $link->query("INSERT INTO tb_roomRates (hotelID,roomID,dateNight,price,enable,available) VALUES('" . $_POST['hotelID'] . "','" . $_POST['roomID'] . "','" . $_POST['date_' . $i] . "','" . $_POST['price_' . $i] . "','" . $_POST['enable_' . $i] . "','" . $_POST['available_' . $i] . "')");
        }
    }
    alerts('setRates','success');
}
?>
<div class="container body">
    <div class="main_container">

        <!-- sidebar menu -->
        <?php include('menu.php'); ?>
        <!-- /sidebar menu -->

        <!-- top navigation -->
        <?php include('userInfo.php') ?>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Create room prices</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <form action="" name="hotel" method="post">
                                    <input type="hidden" name="datepicker1" id="date1">
                                    <input type="hidden" name="datepicker2" id="date2">
                                    <?php if ($_SESSION['level'] == 'super user') { ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <b>Hotel:</b>
                                            <select id="hotel" type="text" name="hotelID" title="hotel"
                                                    required="required"
                                                    class="optional form-control col-md-7 col-xs-12">
                                                <?php getHotels() ?>
                                            </select>
                                        </div>
                                    <?php } else {echo '<input name="hotelID" value="'.$_SESSION['hotelID'].'" type="hidden" >';}?>

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

                                    <br>

                                    <button id="send" type="submit" class="btn btn-success">Search</button>
                                </form>


                                <hr>
                                <?php if ($_SESSION['level'] == 'super user') {
                                    nameHotels($_POST['hotelID']) ;
                                }?>

                            </div>
                            <?php  if ($_POST['hotelID'] > 0) { ?>
                                <input type="hidden" name="permiso" value="S">
                                <input type="hidden" name="hotelID" value="<? echo $_POST['hotelID'] ?>">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <?php
                                        $cont = 1;
                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                        while ($row = $consulta->fetch_object()) {
                                            ?>
                                            <li role="presentation" class=""><a href="#tab_content<? echo $cont ?>" role="tab" id="profile-tab<? echo $cont ?>" data-toggle="tab" aria-expanded="false"><?php echo $row->name ?></a>
                                            </li>
                                            <?php $cont++;
                                        } ?>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <?php
                                        $cont = 1;
                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                        while ($row = $consulta->fetch_object()) {
                                            ?>
                                            <div role="tabpanel" class="tab-pane fade"
                                                 id="tab_content<? echo $cont ?>" aria-labelledby="home-tab">
                                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" name="codigo_b">
                                                    <input type="hidden" name="roomID" value="<?php echo $row->roomID ?>">
                                                    <input type="hidden" name="hotelID" value="<?php echo $_POST['hotelID'] ?>">
                                                    <input type="hidden" name="guardar" value="S">
                                                    <b><?php echo $row->name ?><br><br></b>

                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <?php
                                                            for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i=date("Y-m-d", strtotime($i . "+1 day"))) {
                                                                $date = new DateTime($i);
                                                                echo '<th>' . $date->format('D') . ' ' . $date->format('d') . '</th>';
                                                            }
                                                            ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="20" align="left"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="20" align="left"><b>Price</b></td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $contador = 1;
                                                            for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i=date("Y-m-d", strtotime($i . "+1 day"))) {

                                                                $price = 0;
                                                                $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $i . "' ");
                                                                while ($row2 = $consulta2->fetch_object()) {
                                                                    $price = $row2->price;
                                                                }

                                                                echo '<td>
                                                                          <input type="hidden" name="date_' . $contador . '" value="' . $i . '">
                                                                          <input type="text" value="' . $price . '" name="price_' . $contador . '" class="form-control" placeholder="" style=" padding: 2px 2px 2px 2px">
                                                                      </td>';

                                                                $contador++;} ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="20" align="left"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="20" align="left"><b>Enable</b></td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $contador = 1;
                                                            for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i=date("Y-m-d", strtotime($i . "+1 day"))) {
                                                                $price = 0;
                                                                $enable='';
                                                                $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $i . "' ");
                                                                while ($row2 = $consulta2->fetch_object()) {
                                                                    $enable = $row2->enable;
                                                                }

                                                                if ($enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable_' . $contador . '" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable_' . $contador . '" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                                echo '<td>' . $statusBtn . '</td>';
                                                                $contador++;
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="20" align="left"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="20" align="left"><b>Rooms Available</b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            $contador = 1;
                                                            for ($i = $_POST["datepicker1"]; $i < $_POST["datepicker2"]; $i=date("Y-m-d", strtotime($i . "+1 day"))) {

                                                                $price = 0;
                                                                $available='';
                                                                $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $i . "' ");
                                                                while ($row2 = $consulta2->fetch_object()) {
                                                                    $available = $row2->available;
                                                                }
                                                                echo '<td>
                                                           <input type="text" value="' . $available . '" name="available_' . $contador . '" class="form-control" placeholder="" style=" padding: 5px 5px 5px 5px">
                                                           </td>';
                                                                $contador++;
                                                            }
                                                            ?>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" name="contador" value="<?php echo $contador ?>">
                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="">
                                                            <input type="submit" name="Submit" value="Submit <?php echo $row->name ?>" class="btn btn-success" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                            <?php $cont++;
                                        } ?>

                                    </div>

                                </div>

                            <?php } ?>

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
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>



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
</body>
</html>