<?php
require_once('../models/bookingEngineModel.php');
$geterRoom = new bookingEngineModel();//instancia
$rooms = $geterRoom->getRooms($_POST['start'],$_POST['end'],$_SESSION['hotelID']);//saver
$totDis = $geterRoom->availableRoomsNo; //number of rooms currently available
$roomPrice = $geterRoom->roomPrice; //room's price
$currency = $geterRoom->currency; //room's price
$nightsNumber = $geterRoom->nightsNumber; //nights's No
$checkIn = $geterRoom->checkIn; //nights's No
$checkOut = $geterRoom->checkOut; //nights's No
$hotelID = $geterRoom->hotelID; //nights's No
require_once('../views/roomsDumpView.php');//view
?>