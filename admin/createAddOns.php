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

    <title>Create Add Ons | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- custom -->
    <script src="../js/custom.js"></script>
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <!--Alerts function-->
    <?php include('alerts.php')?>
    <!--Mails function-->
    <?php include('senderMails.php')?>

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

        <!-- instanciamos funcion -->
        <?php createAddOns()?>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Create Add Ons</h3>
                    </div>
                </div>
                <div class="clearfix"></div>



                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="x_panel">
                            <div class="x_content">

                                <form enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate method="post">
                                    <input type="hidden" name="createAddOns" value="true">

                                    <?php if ($_SESSION['level']=='super user'){?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">¿For which hotel?</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="hotel" type="text" name="hotel" title="hotel" required="required" class="optional form-control col-md-7 col-xs-12">
                                                <?php getHotels()?>
                                            </select>
                                        </div>
                                    </div>
<?php } ?>

                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">General Info</a>
                                                </h4>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body">

                                                    <div class="container-vertical">
                                                        <div class="div1">
                                                            <label>Name of the activity</label>
                                                            <input type="text" value="" required name="nameAddOns"  class="" id="" placeholder="">

                                                            <label>Price per person</label>
                                                            <input type="text" value="" name="price" class="" id="" placeholder="" required>

                                                            <label>Currency</label>
                                                            <div class="currency">
                                                                <p>USD:</p> <input type="radio" name="currency" value="USD"  checked>
                                                                <p>CRC:</p> <input type="radio" name="currency" value="CRC">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Details</a>
                                                </h4>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                    <div class="container-vertical">
                                                        <label>Description</label><br>
                                                        <textarea class="" name="description" placeholder="..." rows="3"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Images</a>
                                                </h4>
                                            </div>

                                            <div id="collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                    <div class="container-vertical">

                                                        <div class="div1-middle">
                                                            <img src="http://bos.cr/img/add-ons/bird-watching.png" width="70%">
                                                        </div>

                                                        <div class="div2-middle">
                                                            <input type="file" name="file1" id="file-1" value="" class="inputfile inputfile-2" />
                                                            <label for="file-1">
                                                                <span class="iborrainputfile">Select Image</span>
                                                            </label>
                                                        </div>

                                                        <hr>

                                                        <div class="div1-middle">
                                                            <img src="http://bos.cr/img/add-ons/bird-watching.png" width="70%">
                                                        </div>

                                                        <div class="div2-middle">
                                                            <input type="file" name="file2" id="file-2"  value="" class="inputfile inputfile-2" />
                                                            <label for="file-2">
                                                                <span class="iborrainputfile">Select Image</span>
                                                            </label>
                                                        </div>

                                                        <hr>

                                                        <div class="div1-middle">
                                                            <img src="http://bos.cr/img/add-ons/bird-watching.png" width="70%">
                                                        </div>

                                                        <div class="div2-middle">
                                                            <input type="file" name="file3" id="file-3" value="" class="inputfile inputfile-2" />
                                                            <label for="file-3">
                                                                <span class="iborrainputfile">Select Image</span>
                                                            </label>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="alignright">
                                        <button class="btn btn-success" id="">Save changes</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include('footer.php');?>
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
<!-- validator -->
<script src="../vendors/validator/validator.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>


</body>
</html>