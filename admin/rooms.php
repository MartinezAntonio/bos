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

    <title>Rooms | </title>
    <link rel="shortcut icon" href="http://bos.cr/img/logo.png" />

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


    <style>
        .rates{
            border: solid 2px #26b99a;
            padding: 20px;
        }

        .daterangepicker-setup{
            width: 100%;
            background-color: rgba(38, 172, 185, 0.43);
            border-radius: 25px;
            border: none; !important;
        }

        .add-more-rates{
            float: right;
            font-size: 25px;
            color: #26b99a;
        }
    </style>

    <!-- datepicker calls css-->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <?php include('alerts.php')?>
    <?php deleteRooms($_GET['deleteRoom'])?>


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

        <?php updateRooms($_POST['updateRoomID'])?>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>All Rooms</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <?php if($_SESSION['level']=='super user'){ ?>
                                    <form action="" name="hotel" method="post">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <b>Hotel:</b>
                                            <select id="hotel" type="text" name="hotelID" title="hotel" required="required" class="optional form-control col-md-7 col-xs-12">
                                                <?php getHotels()?>
                                            </select>
                                        </div>
                                        <br><button id="send" type="submit" class="btn btn-success">Search</button>
                                    </form>
                                    <hr>
                                    <?php nameHotels($_POST['hotelID'])?>
                                <?php } ?>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Room Name</th>
                                        <th>Price per Night</th>
                                        <th>Guest Capacity</th>
                                        <th>Number of rooms</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cont=0;
                                    $consulta=0;
                                    $link=conect::conection();
                                    if ($_SESSION['level']=='admin' or $_SESSION['level']=='reservation' ){
                                        //Trae la cantidad de usuarios de su hotel
                                        $consulta = $link->query("select * from tb_rooms where hotelID='".$_SESSION['hotelID']."' ");
                                    }
                                    if ($_SESSION['level']=='super user'){
                                        //trae toda la cantidad de usuarios en el 100% del sistema
                                        $consulta = $link->query("select * from tb_rooms where hotelID='".$_POST['hotelID']."'");
                                    }
                                    while($row = $consulta->fetch_object()) {

                                        if($row->enable=='Y'){
                                            $status='<button type="button" class="btn btn-success btn-xs">Enabled&nbsp;</button>';
                                        }else{
                                            $status='<button type="button" class="btn btn-danger btn-xs">Disabled</button>';
                                        }

                                        if($row->enable=='Y'){
                                            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" checked data-switchery="true" style="display: none;">';
                                        }else{
                                            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" data-switchery="true" style="display: none;">';
                                        }

                                        if($row->currency=='USD'){
                                            $coin='$';
                                        }else{
                                            $coin='&cent;';
                                        }
                                        ?>

                                        <tr>
                                            <td>
                                                <a><?php echo $row->roomID ?></a>
                                            </td>
                                            <td>
                                                <a><?php echo $row->name ?></a>
                                            </td>
                                            <td>
                                                <a><?php echo $coin?><?php echo $row->priceandTaxes ?></a>
                                            </td>
                                            <td>
                                                <a><?php echo $row->adults+$row->children ?></a>
                                            </td>
                                            <td>
                                                <a><?php echo $row->disponibles ?></a>
                                            </td>
                                            <td>
                                                <?php echo $status ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $row->roomID ?>"><i class="fa fa-pencil"></i> Edit </a>
                                                <a class="btn btn-danger btn-xs" href="javascript:modifyRooms(<?php echo $row->roomID ?>)" ><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                        </tr>


                                        <div class="modal fade bs-example-modal-lg<?php echo $row->roomID ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <form enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" method="post" onsubmit="document.getElementById('submitBtn<?php echo $cont ?>').disabled = true;">
                                                        <input type="hidden" name="updateRoomID" value="<?php echo $row->roomID ?>">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel"><?php echo $row->name ?></h4>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="panel-group" id="accordion">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1<?php echo $cont ?>"><li class="fa fa-align-center"></li> General Info</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse1<?php echo $cont ?>" class="panel-collapse collapse in">
                                                                        <div class="panel-body">

                                                                            <div class="container-vertical">

                                                                                <div class="div1">
                                                                                    <label>Room Name</label>
                                                                                    <input type="text" value="<?php echo $row->name ?>" name="name" class="" id="" placeholder="">

                                                                                    <label>Status</label>
                                                                                    <br>
                                                                                    <?php echo $statusBtn ?>
                                                                                </div>

                                                                                <div class="div2">
                                                                                    <label>Adults No.</label>
                                                                                    <input type="text" value="<?php echo $row->adults ?>" name="adults" class="" id="" placeholder="Adults No.">

                                                                                    <label>Childrens No.</label>
                                                                                    <input type="text" value="<?php echo $row->children ?>" name="children" class="" id="" placeholder="Childrens No.">

                                                                                    <label>¿Rooms of this type?</label>
                                                                                    <input type="text" value="<?php echo $row->disponibles ?>" name="disponibles" class="" id="" placeholder="">
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5<?php echo $cont ?>"><li class="fa fa-yelp"></li> Price and taxes</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse5<?php echo $cont ?>" class="panel-collapse collapse">
                                                                        <div class="panel-body">


                                                                            <div class="rates"><!-->

                                                                                <div class="container-vertical">

                                                                                    <div class="div1">
                                                                                        <label> <p>Price</p></label>
                                                                                        <input type="text" name="price" value="<?php echo $row->price ?>" placeholder="Price">
                                                                                    </div>

                                                                                    <div class="div2">
                                                                                        <label> <p>Taxes %</p></label>
                                                                                        <input type="text" name="taxes" value="<?php echo $row->taxes ?>" placeholder="Taxes">
                                                                                    </div>

                                                                                    <hr>

                                                                                    <div class="div2">
                                                                                        <label>Currency</label>
                                                                                        <div class="currency">
                                                                                            <p>USD:</p> <input type="radio" name="currency" value="USD" <?php if($row->currency=='USD'){?> checked <?php } ?>>
                                                                                            <p>CRC:</p> <input type="radio" name="currency" value="CRC" <?php if($row->currency=='CRC'){?> checked <?php } ?>>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>


                                                                            </div><!-->


                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2<?php echo $cont ?>"><li class="fa fa-wifi"></li> Features</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse2<?php echo $cont ?>" class="panel-collapse collapse">
                                                                        <div class="panel-body">

                                                                            <div class="container-vertical">
                                                                                <div class="div1">
                                                                                    <label>Wi-Fi</label>
                                                                                    <input type="checkbox" name="wifi" <?php if($row->wifi=='Y'){?>checked<?php } ?> value="Y"><br>

                                                                                    <label>TV</label>
                                                                                    <input type="checkbox" name="tv" <?php if($row->tv=='Y'){?>checked<?php } ?> value="Y"><br>

                                                                                    <label>Jacuzzi</label>
                                                                                    <input type="checkbox" name="jacuzzi" <?php if($row->jacuzzi=='Y'){?>checked<?php } ?> value="Y"><br>
                                                                                </div>

                                                                                <div class="div2">
                                                                                    <label>Air conditioner</label>
                                                                                    <input type="checkbox" name="air" <?php if($row->air=='Y'){?>checked<?php } ?> value="Y"><br>

                                                                                    <label>Kitchen</label>
                                                                                    <input type="checkbox" name="kitchen" <?php if($row->kitchen=='Y'){?>checked<?php } ?> value="Y"><br>

                                                                                    <label>Pets allowed</label>
                                                                                    <input type="checkbox" name="pets" <?php if($row->pets=='Y'){?>checked<?php } ?> value="Y"><br>
                                                                                </div>

                                                                                <hr>

                                                                                <label>Description</label><br>
                                                                                <textarea class="" name="description" rows="3"><?php echo $row->description ?></textarea>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>




                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3<?php echo $cont ?>"><li class="fa fa-image"></li> Images</a>
                                                                        </h4>
                                                                    </div>

                                                                    <div id="collapse3<?php echo $cont ?>" class="panel-collapse collapse">
                                                                        <div class="panel-body">

                                                                            <div class="container-vertical">

                                                                                <div class="div1-middle">
                                                                                    <img src="../img/rooms/<?php echo $row->img1 ?>" width="70%">
                                                                                </div>

                                                                                <div class="div2-middle">
                                                                                    <input type="file" name="file1" id="file-1<?php echo $cont ?>" value="<?php echo $row->img1 ?>" class="inputfile inputfile-2" />
                                                                                    <label for="file-1<?php echo $cont ?>">
                                                                                        <span class="iborrainputfile">Select Image</span>
                                                                                    </label>
                                                                                </div>

                                                                                <hr>

                                                                                <div class="div1-middle">
                                                                                    <img src="../img/rooms/<?php echo $row->img2 ?>" width="70%">
                                                                                </div>

                                                                                <div class="div2-middle">
                                                                                    <input type="file" name="file2" id="file-2<?php echo $cont ?>"  value="<?php echo $row->img2 ?>" class="inputfile inputfile-2" />
                                                                                    <label for="file-2<?php echo $cont ?>">
                                                                                        <span class="iborrainputfile">Select Image</span>
                                                                                    </label>
                                                                                </div>

                                                                                <hr>

                                                                                <div class="div1-middle">
                                                                                    <img src="../img/rooms/<?php echo $row->img3 ?>" width="70%">
                                                                                </div>

                                                                                <div class="div2-middle">
                                                                                    <input type="file" name="file3" id="file-3<?php echo $cont ?>" value="<?php echo $row->img3 ?>" class="inputfile inputfile-2" />
                                                                                    <label for="file-3<?php echo $cont ?>">
                                                                                        <span class="iborrainputfile">Select Image</span>
                                                                                    </label>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success" id="submitBtn<?php echo $cont ?>">Save Changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php $cont++;} ?>
                                    </tbody>
                                </table>


                            </div>




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
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>

<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="http://bos.cr/js/custom.js"></script>
</body>
</html>