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

    <title>Home | </title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <?php include('alerts.php')?>
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


                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Your Profile</h2>

                                <div class="clearfix"></div>
                            </div>
                            <?php updateUsers($_POST['userID']); ?>

                            <?php
                            $consulta = $link->query("select * from tb_user where userID='".$_SESSION['userID']."' ");
                            while($row = $consulta->fetch_object()) {
                              $userID=$row->userID;
                              $level=$row->level;
                              $name=$row->name;
                              $email=$row->email;
                              $phone=$row->phone;
                              if($row->imgProfile==''){
                                  $imgProfile='http://bos.cr/img/avatar.png';
                              }else{
                                  $imgProfile='../img/profile/'.$row->imgProfile;
                              }
                              $password=$row->password;
                            } ?>

                            <form enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate method="post" >
                                <input type="hidden" name="modifyUsers" value="true">
                                <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                <input type="hidden" name="level" value="<?php echo $level ?>">
                                <input type="hidden" name="enable" value="Y">
                                <input type="hidden" name="passHashed" value="<?php echo $password?>">

                                <div class="x_content">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="<?php echo $name ?>" name="fullname" placeholder="" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email" value="<?php echo $email ?>" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Telephone <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" required="required" data-validate-minmax="8,11" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Update Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3 btn-full">
                                                <button id="send" type="submit" class="btn btn-success" style="width: 100%">Save changes</button>
                                            </div>
                                        </div>


                                        <div>
                                            <br><br><br>
                                        </div>

                                    </div>

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div>
                                            <div class="profile-img-container img-circle">
                                                <input type="file" name="file" />
                                                <img src="<?=$imgProfile ?>" class="img-thumbnail img-circle img-responsive" style="width: 250px;height: 250px"/>
                                                <div class="icon-wrapper">
                                                    <i class="fa fa-upload fa-3x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </form>









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
<!-- validator -->
<script src="../vendors/validator/validator.js"></script>
<!-- PNotify -->
<script src="../vendors/pnotify/dist/pnotify.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>

