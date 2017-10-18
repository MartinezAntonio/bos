<?php
if(!isset($_POST['hotelID_'])){
    header('location: http://bos.cr/');//Si no existen datos post de reserva o usuario recarga la pagina redireccionar
}

require_once('libs/models/reservationModel.php');
$geterRoomReserve = new reservationModel();
$roomsR = $geterRoomReserve->getRoomsR($_POST['hotelID_'],$_POST['CheckIn_'],$_POST['CheckOut_']);
$roomsNo = $geterRoomReserve->roomsNo;
$roomsToReserve = $geterRoomReserve->roomIDs;
$nightsNumber = $geterRoomReserve->nightsNumber;
$currency = $geterRoomReserve->currency;
$coin = $geterRoomReserve->coin;
$subtotal = $geterRoomReserve->subtotal;
$lastSubtotal = $geterRoomReserve->lastSubtotal;
$taxes = $geterRoomReserve->taxes;
$total = $geterRoomReserve->total;
$price = $geterRoomReserve->price;
$hotelData = $geterRoomReserve->hotelData;
//----------------------//

require_once('libs/models/reservationCheckerModel.php');
$geterRoomReserveChecker = new reservationCheckerModel();
$roomsChecker = $geterRoomReserveChecker->getRoomsChecker($_POST['hotelID_'],$_POST['CheckIn_'],$_POST['CheckOut_'],$roomsToReserve,$roomsNo,count($roomsToReserve));
$reservable = $geterRoomReserveChecker->reservable;

//----------------------//

$invoice=0;
if($reservable==true){//reservamos la habitacion momentaneamente//
    require_once('libs/models/bookerModel.php');
    $getRoomsBooker = new bookerModel();
    $getRoomsBooker->getRoomsBooker($_POST['hotelID_'],$_POST['CheckIn_'],$_POST['CheckOut_']);
    $invoice=$getRoomsBooker->invoice;
}

//----------------------//

require_once('libs/views/reservationView.php');
?>