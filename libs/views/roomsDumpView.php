<?php require "../models/setLangModel.php"; ?>
<div class="col-container">
    <div id="engine">
        <h2 class="center-block rooms-title"><?php echo $lang['accommodations']?></h2>

        <?php
        $cont=1;
        $contArray=0;
        foreach ($rooms as $row){?>

            <!-------------------------------------->
            <div class="col-sm-4 rooms-item">
                <div class="center rooms-item-container">

                    <a data-toggle="modal" class="portfolio-link" data-target=".room-detail<?php echo $cont?>">
                        <div class="caption">
                            <div class="caption-content">
                                <h2><?php echo $lang['more_details']?></h2>
                            </div>
                        </div>
                        <img src="../img/rooms/<?=$row['img1']?>" class="room-img-slider" alt="<?php echo $row['name'] ?>">
                    </a>

                    <h3 class="text-center"><?=$row['name'] ?></h3>

                    <div class="center">
                     <span class="spinner">
                      <span class="sub btn-mod-room-qty">-</span>
                       <input type="text" name="cantidad" min="0" max="<?php echo $totDis[$contArray] ?>" value="0" class="RoomIDClass numberInput" data-indice="<?php echo $cont?>" data-room="<?php echo $row['roomID']?>" data-name="<?php echo $row['name']?>" data-price="<?php echo $roomPrice[$contArray]?>" id="selecCantidad_<?php echo $cont ?>"/>
                      <span class="add btn-mod-room-qty">+</span>
                    </span>
                    </div>

                    <!---- trae la cantidad de habitaciones disponibles, personas x habitacion y precio---->
                    <div class="center description-room">
                        <span><li class="fa fa-home"></li> <?php echo $totDis[$contArray] ?></span>
                        <span><li class="fa fa-user"></li> <?php echo $qtyPerson=$row['adults']+$row['children'] ?></span>
                        <span><?php echo $currency[$contArray].$roomPrice[$contArray] ?></span>
                    </div>

                </div>
            </div>
            <!-------------------------------------->



            <!-- Modal-room-detail -->
            <div class="modal fade room-detail<?php echo $cont?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content-room-detail">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                            <h2 class="modal-title" id="myModalLabel"><?php echo $row['name'] ?></h2>
                        </div>
                        <div class="modal-body">

                            <!-- Wrapper for slides -->
                            <div id="<?=$row['roomID']?>" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="../img/rooms/<?=$row['img1']?>" class="room-img-slider" alt="<?php echo $row['name'] ?>">
                                    </div>

                                    <div class="item">
                                        <img src="../img/rooms/<?=$row['img2']?>" class="room-img-slider" alt="<?php echo $row['name'] ?>">
                                    </div>

                                    <div class="item">
                                        <img src="../img/rooms/<?=$row['img3']?>" class="room-img-slider" alt="<?php echo $row['name'] ?>">
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#<?php echo $row['roomID']?>" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#<?php echo $row['roomID']?>" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>

                            </div>
                            <!-- Wrapper for slides -->

                            <div><br></div>

                            <div class="first-container">

                                <h3><?=$lang['theroom']?></h3>
                                <div class="div-left">
                                    <p><b><?=$lang['room_category']?> :</b> <?php echo $row['name']?></p>
                                    <p><b><?=$lang['price_per_night']?> :</b> <?php echo $currency[$contArray].$roomPrice[$contArray]?></p>
                                </div>

                                <div class="div-right">
                                    <p><b><?=$lang['capacity']?> :</b> <?php echo $qtyPerson=$row['adults']+$row['children'] ?></p>
                                    <p><b><?=$lang['beddings']?> :</b> <?php echo $row['beds']?></p>
                                </div>

                                <hr>

                                <h3><?=$lang['features']?></h3>
                                <div class="div-left-feat">
                                    <?php if($row['tv']=='Y'){?><p> <li class="fa fa-tv feat-icon"></li> TV</p><?php } ?>
                                    <?php if($row['wifi']=='Y'){?><p> <li class="fa fa-wifi feat-icon"></li> Wi-fi</p><?php } ?>
                                    <?php if($row['air']=='Y'){?><p> <li class="fa fa-check feat-icon"></li> <?=$lang['air_conditioner']?></p><?php } ?>
                                </div>

                                <div class="div-right-feat">
                                    <?php if($row['minibar']=='Y'){?><p> <li class="fa fa-filter feat-icon"></li> Mini Bar</p><?php } ?>
                                    <?php if($row['pets']=='Y'){?><p> <li class="fa fa-paw feat-icon"></li> <?=$lang['pets_allowed']?></p><?php } ?>
                                    <?php if($row['jacuzzi']=='Y'){?><p> <li class="fa fa-check feat-icon"></li> Jacuzzi</p><?php } ?>
                                </div>

                                <hr>

                                <div>
                                    <h3><?=$lang['description']?></h3>
                                    <p class="modal-p-description"><?php if($_SESSION['lang']=='es'){echo $row['descripcion'];}else{echo $row['description'];}?></p>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer text-center">
                            <form action="reservation.php" method="post">
                                <input type="hidden" name="hotelID_" value="<?=$hotelID ?>" id="hotelID_">
                                <input type="hidden" name="CheckIn_" value="<?=$checkIn?>">
                                <input type="hidden" name="CheckOut_" value="<?=$checkOut?>">
                                <input type="hidden" name="roomID<?=$row['roomID']?>" value="1">
                                <input type="submit" value="<?=$lang['book']?>" class="btn btn-success btn-modal-book">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal-room-detail -->

            <?php $cont++; $contArray++;}?>

        <!-- These values are received by custom.js for calculating the detail of rooms -->
        <input type="hidden" value="<?=$cont?>" id="forIndice" name="forIndice">
        <input type="hidden" value="<?=$nightsNumber?>" id="nights" name="nights">
    </div>
</div>
