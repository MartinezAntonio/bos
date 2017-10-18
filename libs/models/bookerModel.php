<?php
class bookerModel{

    private $db;
    public $invoice;
    public $roomsDump;
    public $availableRoomsNo;
    public $roomPrice;
    public $currency;
    public $nightsNumber;
    public $checkIn;
    public $checkOut;
    public $hotelID;

    public function __construct(){

        require_once('libs/models/config.php');
        $this->db=conect::conection();
        $this->roomsDump=array();
        $this->availableRoomsNo=array();
        $this->roomPrice=array();
        $this->currency=array();
        $this->nightsNumber=0;
        $this->checkIn=0;
        $this->checkOut=0;
        $this->hotelID=0;
        $this->invoice=0;

    }

    public function getRoomsBooker($hotelID,$checkIn,$checkOut){

        //get nigths No
        $start_ts=strtotime($checkIn);
        $end_ts=strtotime($checkOut);
        $result_dateCalculation = $end_ts - $start_ts;
        $nights=round($result_dateCalculation / 86400);
        $fecha_reserva = date("Y-m-d H:i:s");
        $userID='888';

        $roomIDconcat=null;
        $roomNameconcat=null;
        $Total_reservation_cost=null;
        $rooms_no=null;

        $consulta = $this->db->query("select * from tb_rooms where hotelID='".$hotelID."' ORDER BY roomID ASC")or die ("Couldn't execute query: ".mysqli_error($this->db));
        while ($row = $consulta->fetch_assoc()) {

            if ($_POST['roomID'.$row['roomID']] > 0) {
                $rooms_no=$_POST['roomID'.$row['roomID']];
                $roomIDconcat.=$row['roomID'].'|';
                $roomNameconcat.=$row['name'].'|';
                $tot_x_room=$_POST['roomID' . $row['roomID']]*$row['price'];
                $Total_reservation_cost=$Total_reservation_cost+$tot_x_room;
            }

        }

        //CONSECUTIVE RESERVE
        $reserveID=0;
        $rs = $this->db->query("SELECT MAX(invoice) AS invoice FROM invoice")or die ("Couldn't execute query: ".mysqli_error($this->db));
        if ($row= mysqli_fetch_row($rs)) {
            $reserveID= trim($row[0]);
            $reserveID=$reserveID+1;
            $insert=$this->db->query("INSERT INTO invoice (invoice) VALUES('".$reserveID."')")or die ("Couldn't execute query: ".mysqli_error($this->db));
        }

        $invoice=$reserveID.'A';
        $this->invoice=$invoice;
        $this->nightsNumber=$nights;

        //INSERT
        $insertInit =$this->db->query("INSERT INTO tb_reserve (reserveID,hotelID,guestID,roomID,rooms_name,rooms_no,nights_no,days_no,arrival,departure,fecha_reserva,total,currency,status,paid) VALUES('".$invoice."','".$hotelID."','".$userID."','".$roomIDconcat."','".$roomNameconcat."','".$rooms_no."','".$nights."','".$nights."','".$checkIn."','".$checkOut."','".$fecha_reserva."','".$Total_reservation_cost."','USD','PROCESSING','NO')")or die ("Couldn't execute query: ".mysqli_error($this->db));

        //CONSECUTIVE RESERVE
        $consultaInit = $this->db->query("select * from tb_rooms where hotelID='".$hotelID."' ORDER BY roomID ASC")or die ("Couldn't execute query: ".mysqli_error($this->db));
        while($rowInit = $consultaInit->fetch_assoc()) {

            if ($_POST['roomID'.$rowInit['roomID']] > 0) {
                $tot_room=$_POST['roomID'.$rowInit['roomID']];
                $roomID=$rowInit['roomID'];
                for ($j = 1; $j <= $tot_room; $j++) {
                    for ($i = $checkIn; $i < $checkOut; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
                        $insert = $this->db->query("INSERT INTO tb_reserve_details (hotelID,roomID,reserveID,userID,fecha_reserva) VALUES('".$hotelID."','".$roomID."','".$invoice."','".$userID."','".$i."')")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    }
                }
            }

        }


        return true;//Dump result
    }


}
?>






