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

    <title>Users | </title>

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
    <!--alertify-->
    <script src="../alertify/alertify.min.js"></script>
    <link rel="stylesheet" href="../alertify/css/alertify.min.css"/>
    <link rel="stylesheet" href="../alertify/css/themes/default.min.css"/>
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <?php include('alerts.php')?>

    <style>
        .modal-footer {
            padding: 15px;
            text-align: right;
            border-top: none !important;
        }

        .form-control.has-feedback-left {
            padding-left: 15px !important;
        }
    </style>

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

        <?php updateUsers($_POST['updateUserID'])?>
        <?php deleteUsers($_GET['deleteUser'])?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>All users</h3>
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
                                        <br><button id="send" type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                    <hr>
                                <?php } ?>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <!-- start project list -->
                                <table class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th style="width: 1%">ID</th>
                                        <th style="width: 20%">Name</th>
                                        <th>Hotel</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th style="width: 20%">Edit</th>
                                    </tr>
                                    </thead>

                                    <?php

                                    /*-- Super User --*/
                                    if ($_SESSION['level']=='super user'){
                                        $consulta = $link->query("select * from tb_user where hotelID='".$_POST['hotelID']."' ");
                                    }
                                    /*-- Super User --*/

                                    /*-- Hotel Admin --*/
                                    if ($_SESSION['level']=='admin' or $_SESSION['level']=='reservation' ){
                                        $consulta = $link->query("select * from tb_user where hotelID='".$_SESSION['hotelID']."' ");
                                    }
                                    /*-- Hotel Admin --*/

                                    while($row = $consulta->fetch_object()) {

                                    $userID=$row->userID;
                                    $name=$row->name;
                                    $creationDate=$row->creationDate;
                                    $level=$row->level;
                                    $phone=$row->phone;
                                    $email=$row->email;
                                    $password=$row->password;
                                    $hotelName=$row->hotelName;

                                    if($row->enable=='Y'){
                                        $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" checked data-switchery="true" style="display: none;">';
                                        $status='<button type="button" class="btn btn-success btn-xs">Enabled&nbsp;</button>';
                                    }else{
                                        $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" data-switchery="true" style="display: none;">';
                                        $status='<button type="button" class="btn btn-danger btn-xs">Disabled</button>';
                                    }
                                    ?>

                                    <tbody>
                                    <tr>
                                        <td><?php echo $userID ?></td>
                                        <td>
                                            <a><?php echo $name?></a>
                                            <br/>
                                            <small>Creation Date (<?php echo $creationDate?>)</small>
                                        </td>
                                        <td>
                                            <a><?php echo $hotelName?></a>
                                        </td>
                                        <td class="project_progress">
                                            <a><?php echo $level?></a>
                                        </td>
                                        <td>
                                            <?php echo $status ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $userID?>"><i class="fa fa-pencil"></i> Edit </a>
                                            <a class="btn btn-danger btn-xs" href="javascript:modifyUsers(<?php echo $userID.','.$_SESSION['userID']?>)"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>

                                    <!-- Large modal -->
                                    <div class="modal fade bs-example-modal-lg<?php echo $userID ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <form class="form-horizontal form-label-left input_mask" method="post">
                                                    <input type="hidden" name="updateUserID" value="<?php echo $userID?>">
                                                    <input type="hidden" name="passHashed" value="<?php echo $password?>">
                                                    <input type="hidden" name="hotelID" value="<?php echo $_SESSION['hotelID']?>">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel"><?php echo $name?></h4>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>Name</label>
                                                            <input type="text" value="<?php echo $name ?>" name="fullname" class="form-control has-feedback-left" id="inputSuccess2" required placeholder="First Name">
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>Level</label>
                                                            <select type="text" name="level" class="form-control has-feedback-left" id="inputSuccess3">
                                                                <option value="<?php echo $level ?>"><?php echo $level ?></option>
                                                                <option value="super user">super user</option>
                                                                <option value="admin">Administrator</option>
                                                                <option value="reservation">Reservation</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>Email</label>
                                                            <input type="email" value="<?php echo $email ?>" name="email" class="form-control has-feedback-left" id="inputSuccess4" required placeholder="Email">
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>Telephone</label>
                                                            <input type="text" value="<?php echo $phone ?>" name="phone" class="form-control" id="inputSuccess5" placeholder="Phone">
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>New Password</label>
                                                            <input type="text" value="" name="password" class="form-control" id="inputSuccess5" placeholder="New Password">
                                                        </div>

                                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                            <label>Status</label>
                                                            <?php echo $statusBtn ?>
                                                        </div>

                                                        <div>
                                                            <br>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Save changes</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Large modal -->
                                    <?php $cont++;}?>

                                    </tbody>
                                </table>
                                <!-- end project list -->


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
<!-- Custom Theme Scripts -->
<script src="../js/custom.js"></script>
<!-- validator -->
<script src="../vendors/validator/validator.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>
</body>
</html>