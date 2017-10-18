<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('../libs/models/config.php');
    $link=conect::conection();
    include('../session.php');
    include('../functions.php');

    if (isset($ano) == "") $ano = date("Y");
    if (isset($mes) == "") $mes = date("m");
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">



    <script language='javascript'>
        function mOvr(src, clrOver) {
            if (!src.contains(event.fromElement)) {
                src.style.cursor = 'hand';
                src.bgColor = clrOver;
            }
        }
        function mOut(src, clrIn) {
            if (!src.contains(event.toElement)) {
                src.style.cursor = 'default';
                src.bgColor = clrIn;

            }
        }
        function mclick(src) {
            if (event.srcElement.tagName == 'TD') {
                src.children.tags('a')[0].click();
            }
        }
        function get_data(dia, mes, ano) {
            opener.<?=$campo?>.value = "" + dia + "/" + mes + "/" + ano + "";
            self.close();
        }
    </script>
    <style type="text/css">
        A:link, A:hover {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-style: normal;
            text-decoration: none;
        }

        A {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-style: normal;
            text-decoration: none;
        }

        TD {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-style: normal;
        }

    </style>

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

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">


                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Reservations Summary</h2>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

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
                                <?php } else {
                                    $_POST['hotelID'] = $_SESSION['hotelID'];
                                }    ?>

                                <?php if ($_POST['hotelID']>0){  ?>

                                    <?php
                                    if ($_GET['mov'] == 'S') {
                                        if ($_GET["mes"] < 10) {
                                            $mes = '0' . $_GET["mes"];
                                        } else {
                                            $mes = $_GET["mes"];
                                        }
                                    }
                                    //exit();
                                    $col = 1;

                                    $linha = 0;

                                    $domingos = array("", "", "", "", "", "");
                                    $segundas = array("", "", "", "", "", "");
                                    $tercas = array("", "", "", "", "", "");
                                    $quartas = array("", "", "", "", "", "");
                                    $quintas = array("", "", "", "", "", "");
                                    $sextas = array("", "", "", "", "", "");
                                    $sabados = array("", "", "", "", "", "");

                                    for ($dias = 1; $dias <= 31; $dias++) {
                                        if (checkdate($mes, $dias, $ano)) {
                                            $data = mktime(0, 0, 0, $mes, $dias, $ano);
                                            $today = getdate($data);
                                            $dia_semana = $today["wday"];
                                            switch ($dia_semana) {
                                                case 0:
                                                    $domingos[$linha] = $today["mday"];
                                                    break;
                                                case 1:
                                                    $segundas[$linha] = $today["mday"];
                                                    break;
                                                case 2:
                                                    $tercas[$linha] = $today["mday"];
                                                    break;
                                                case 3:
                                                    $quartas[$linha] = $today["mday"];
                                                    break;
                                                case 4:
                                                    $quintas[$linha] = $today["mday"];
                                                    break;
                                                case 5:
                                                    $sextas[$linha] = $today["mday"];
                                                    break;
                                                case 6:
                                                    $sabados[$linha] = $today["mday"];
                                                    $linha++;
                                                    break;
                                            }

                                        } else {
                                            break;
                                        }
                                    }

                                    $data = mktime(0, 0, 0, $mes, 01, $ano);
                                    $today = getdate($data);
                                    $mes_texto = nome_mes($today["month"]);

                                    $proximo_mes = $mes + 1;
                                    $proximo_ano = $ano;

                                    $anterior_mes = $mes - 1;
                                    $anterior_ano = $ano;

                                    if ($proximo_mes == 13) {
                                        $proximo_mes = 1;
                                        $proximo_ano = $ano + 1;
                                    }

                                    if ($anterior_mes == 0) {
                                        $anterior_mes = 12;
                                        $anterior_ano = $ano - 1;
                                    }
                                    ?>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr style="background-color: #F5F7FA">
                                            <th align="center"><a
                                                        href="?ano=<?= $anterior_ano ?>&mes=<?= $anterior_mes ?>&campo=<?= $campo ?>&mov=S"><i
                                                            class="fa fa-arrow-circle-left"></i></a></th>
                                            <th colspan=5><b><?= $mes_texto ?> / <?= $ano ?></b></th>
                                            <th align="center"><a
                                                        href="?ano=<?= $proximo_ano ?>&mes=<?= $proximo_mes ?>&campo=<?= $campo ?>&mov=S"><i
                                                            class="fa fa-arrow-circle-right"></i></a></th>
                                        </tr>
                                        <tr style="background-color: #F5F7FA">
                                            <th><b>Sun</b></th>
                                            <th><b>Mon</b></th>
                                            <th><b>Tue</b></th>
                                            <th><b>Wed</b></th>
                                            <th><b>Thu</b></th>
                                            <th><b>Fri</b></th>
                                            <th><b>Sat</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <? for ($lin = 0; $lin <= $linha; $lin++) { ?>

                                            <tr>
                                                <td >

                                                    <?php
                                                    if ($domingos[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$domingos[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $domingos[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='".$_POST['hotelID']."' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }
                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>



                                                </td>

                                                <td <? if (trim($segundas[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $segundas[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($segundas[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$segundas[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $segundas[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>

                                                </td>

                                                <td <? if (trim($tercas[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $tercas[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($tercas[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$tercas[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $tercas[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>

                                                </td>

                                                <td <? if (trim($quartas[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $quartas[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($quartas[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$quartas[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $quartas[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td <? if (trim($quintas[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $quintas[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($quintas[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$quintas[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $quintas[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td <? if (trim($sextas[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $sextas[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($sextas[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$sextas[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $sextas[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>
                                                </td>


                                                <td <? if (trim($sabados[$lin]) != "") { ?>bgcolor="#ffffff"
                                                    onMouseOver="mOvr(this,'#919FB0')" onMouseOut="mOut(this,'#ffffff')"
                                                    onclick="mclick(this);get_data('<?= $sabados[$lin] ?>','<?= $mes ?>','<?= $ano ?>')"<? } ?>>

                                                    <?php
                                                    if ($sabados[$lin]>0) {
                                                        echo '<a style="color: #337AB7;font-weight: bold">'.$sabados[$lin].' / '.$mes_texto.'</a>';
                                                        $fecha = $ano . '-' . $mes . '-' . $sabados[$lin];
                                                        $consulta = $link->query("select * from tb_rooms WHERE hotelID='" . $_POST['hotelID'] . "' and enable='Y' ");
                                                        while ($row = $consulta->fetch_object()) {
                                                            $price=0;$available=0; $enable='';$statusBtn='';
                                                            $consulta2 = $link->query("select * from tb_roomRates WHERE hotelID='" . $_POST['hotelID'] . "' and roomID='" . $row->roomID . "' and dateNight='" . $fecha . "' ");
                                                            while ($row2 = $consulta2->fetch_object()) {
                                                                if ($row2->price<1 and $row2->enable == 'Y'){
                                                                    $price = '<font color="red"><b><b>'.$row2->price.'</b></font>';
                                                                } else {
                                                                    $price = $row2->price;
                                                                }

                                                                $enable = $row2->enable;

                                                                if ($row2->available<1 and $row2->enable == 'Y'){
                                                                    $available = '<font color="red"><b><b>'.$row2->available.'</b></font>';
                                                                } else {
                                                                    $available = $row2->available;
                                                                }

                                                                if ($row2->enable == 'Y') {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" checked data-switchery="true" style="display: none;">';
                                                                } else {
                                                                    $statusBtn = '<input type="checkbox" value="Y" name="enable" disabled="disabled" class="js-switch" data-switchery="true" style="display: none;">';
                                                                };
                                                            }


                                                            echo '
                                                <table  class="table table-bordered" style="font-size: 12px">
                                                  <thead>
                                                    <tr>
                                                      <th colspan="2" style="padding: 2px 2px 2px 2px;background-color: #F7F7F7">' . $row->name . '</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" >Price: $ ' . $price . ' </td>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px">' . $statusBtn . '</td>
                                                    </tr>
                                                    <tr>
                                                      <td style="font-size: 12px;padding: 2px 2px 2px 2px" colspan="2">Rooms available: ' . $available . ' </td>

                                                    </tr>
                                                  </tbody>

                                                </table>';

                                                        }
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>


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
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>

<?
function nome_mes($nome)
{
    switch ($nome) {
        case "January":
            return "Enero";
            Break;
        case "February":
            return "Febrero";
            Break;
        case "March":
            return "Marzo";
            Break;
        case "April":
            return "Abril";
            Break;
        case "May":
            return "Mayo";
            Break;
        case "June":
            return "Junio";
            Break;
        case "July":
            return "Julio";
            Break;
        case "August":
            return "Agosto";
            Break;
        case "September":
            return "Setiembre";
            Break;
        case "October":
            return "Octubre";
            Break;
        case "November":
            return "Noviembre";
            Break;
        case "December":
            return "Diciembre";
            Break;
    }
} ?>

