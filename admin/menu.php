<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo getProfileImg()?>" alt="Profile Image" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2><br>&nbsp; <?php echo $userDetails->name; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <?php if ($userDetails->level=='super user'){ ?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
                <div class="menu_section">
                    <h3><?php echo $userDetails->level; ?></h3>
                    <ul class="nav side-menu">

                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard </a></li>

                        <li><a><i class="fa fa-home"></i> Reservations <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="reservations.php">Reservations</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createUsers.php">Create users</a></li>
                                <li><a href="users.php">All users</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Hotels <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createHotels.php">Create Hotels</a></li>
                                <li><a href="hotels.php">All hotels</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Rooms <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createRooms.php">Create Rooms</a></li>
                                <li><a href="rooms.php">All Rooms</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-bicycle"></i> Add Ons <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createAddOns.php">Create Add Ons</a></li>
                                <li><a href="addons.php">All Add Ons</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-yelp"></i> Rates <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createPriceRooms.php">Create</a></li>
                                <li><a href="priceRooms.php">View Rates</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page&nbsp;&nbsp; <span class="label label-success pull-right">Soon</span></a></li>
                    </ul>
                </div>

            </div>
            <!-- /sidebar menu -->
        <?php } ?>

        <?php if ($userDetails->level=='admin'){ ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
                <div class="menu_section">
                    <!-- sidebar menu -->
                    <h3><?php echo $userDetails->level; ?></h3>
                    <ul class="nav side-menu">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard </a></li>

                        <li><a><i class="fa fa-home"></i> Reservations <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="reservations.php">Reservations</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createUsers.php">Create users</a></li>
                                <li><a href="users.php">All users</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Rooms<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createRooms.php">Create Rooms</a></li>
                                <li><a href="rooms.php">All Rooms</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-bicycle"></i> Add Ons <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createAddOns.php">Create Add Ons</a></li>
                                <li><a href="addons.php">All Add Ons</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-yelp"></i> Rates <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createPriceRooms.php">Create</a></li>
                                <li><a href="priceRooms.php">View Rates</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->
        <? } ?>

        <?php if ($userDetails->level=='reservation'){ ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
                <div class="menu_section">
                    <!-- sidebar menu -->
                    <h3><?php echo $userDetails->level; ?></h3>
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-home"></i> Reservations <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="reservations.php">Reservations</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Rooms <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createRooms.php">Create Rooms</a></li>
                                <li><a href="rooms.php">All Rooms</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->
        <?php } ?>


        <?php if ($userDetails->level=='menu_original'){ ?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
                <div class="menu_section">
                    <h3><?php echo $userDetails->level; ?></h3>
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-home"></i> Reservations <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="reservations.php">Reservations</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createUsers.php">Create users</a></li>
                                <li><a href="users.php">All users</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Hotels <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createHotels.php">Create Hotels</a></li>
                                <li><a href="hotels.php">All hotels</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-hotel"></i> Rooms <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="createRooms.php">Create Rooms</a></li>
                                <li><a href="rooms.php">All Rooms</a></li>
                            </ul>
                        </li>
                        <!-- <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="general_elements.html">General Elements</a></li>
                                 <li><a href="media_gallery.html">Media Gallery</a></li>
                                 <li><a href="typography.html">Typography</a></li>
                                 <li><a href="icons.html">Icons</a></li>
                                 <li><a href="glyphicons.html">Glyphicons</a></li>
                                 <li><a href="widgets.html">Widgets</a></li>
                                 <li><a href="invoice.html">Invoice</a></li>
                                 <li><a href="inbox.html">Inbox</a></li>
                                 <li><a href="calendar.html">Calendar</a></li>
                             </ul>
                         </li>-->
                        <!-- <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="tables.html">Tables</a></li>
                                 <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                             </ul>
                         </li>-->
                        <!--<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="chartjs.html">Chart JS</a></li>
                                <li><a href="chartjs2.html">Chart JS2</a></li>
                                <li><a href="morisjs.html">Moris JS</a></li>
                                <li><a href="echarts.html">ECharts</a></li>
                                <li><a href="other_charts.html">Other Charts</a></li>
                            </ul>
                        </li>-->
                        <!-- <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                 <li><a href="fixed_footer.html">Fixed Footer</a></li>
                             </ul>
                         </li>-->
                    </ul>
                </div>
                <div class="menu_section">
                    <h3>Live On</h3>
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="e_commerce.html">E-commerce</a></li>
                                <li><a href="projects.html">Projects</a></li>
                                <li><a href="project_detail.html">Project Detail</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="profile.html">Profile</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="page_403.html">403 Error</a></li>
                                <li><a href="page_404.html">404 Error</a></li>
                                <li><a href="page_500.html">500 Error</a></li>
                                <li><a href="plain_page.html">Plain Page</a></li>
                                <li><a href="login.html">Login Page</a></li>
                                <li><a href="pricing_tables.html">Pricing Tables</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="#level1_1">Level One</a>
                                <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li class="sub_menu"><a href="level2.html">Level Two</a>
                                        </li>
                                        <li><a href="#level2_1">Level Two</a>
                                        </li>
                                        <li><a href="#level2_2">Level Two</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#level1_2">Level One</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /sidebar menu -->
        <?php } ?>
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>