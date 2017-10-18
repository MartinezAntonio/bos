<?php
class bookingEngineModel{

    private $db;
    public $roomsDump;
    public $availableRoomsNo;
    public $roomPrice;
    public $currency;
    public $nightsNumber;
    public $checkIn;
    public $checkOut;
    public $hotelID;

    public function __construct(){

        require_once('../models/config.php');
        $this->db=conect::conection();
        $this->roomsDump=array();
        $this->availableRoomsNo=array();
        $this->roomPrice=array();
        $this->currency=array();
        $this->nightsNumber=0;
        $this->checkIn=0;
        $this->checkOut=0;
        $this->hotelID=0;

    }

    public function getRooms($checkIn,$checkOut,$hotelID){


        /*-------------------ROOM-RETURNER-AVAILABLE------------------------*/
        $consulta0 = $this->db->query("select * from tb_reserve where status='PROCESSING' and fecha_reserva < (NOW() - INTERVAL 5 MINUTE) ");
        while ($row0 = $consulta0->fetch_assoc()) {

            $delete01=$this->db->query("Delete From tb_reserve where reserveID='".$row0['reserveID']."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));//reset table
            $delete02=$this->db->query("Delete From tb_reserve_details where reserveID='".$row0['reserveID']."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));//reset table

        }
        /*-------------------ROOM-RETURNER-AVAILABLE------------------------*/



        //get nigths No
        $start_ts=strtotime($checkIn);
        $end_ts=strtotime($checkOut);
        $result_dateCalculation = $end_ts - $start_ts;
        $nights=round($result_dateCalculation / 86400);
        $available_actual=0;
        $available=0;
        $enableRoom=0;
        $coin=0;
        $cont=1;
        $consulta = $this->db->query("select * from tb_rooms where hotelID='".$hotelID."' and enable='Y' order by category_id ASC")or die ("Couldn't execute query: ".mysqli_error($this->db));
        while ($row = $consulta->fetch_assoc()) {

            $price=0;
            $available2 = 'YES';
            $select_1 = $this->db->query("select * from tb_rooms where hotelID='".$hotelID."' and roomID='".$row['roomID']."' and enable='Y' order by category_id ASC ")or die ("Couldn't execute query: ".mysqli_error($this->db));
            while ($row7 = $select_1->fetch_assoc()) {

                //-----
                $delete=$this->db->query("Delete From tb_values_comparison");//reset table

                if($row['currency']=='USD'){
                    $coin='$';
                }else{
                    $coin='&cent;';
                }

                $id = $row7['roomID'];
                $available = 'YES';

                for ($i = $checkIn; $i < $checkOut; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {

                    $disonible_x_habitacion=0; $enableRoom='Y';
                    $select2 = $this->db->query("select * from tb_roomRates where hotelID='".$hotelID."' and roomID='".$id."' and dateNight='".$i."' and enable='Y'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    while ($row2 = $select2->fetch_assoc()) {
                        $disonible_x_habitacion = $row2['available']; //echo '<br>';

                        //if ($row['taxes']>0){
                        //  $price= $price+($row2['price']+($row2['price']*($row['taxes']/100)));
                        //} else {
                        $price= $price+$row2['price'];
                        //}

                    }

                    $select2 = $this->db->query("select * from tb_roomRates where hotelID='".$hotelID."' and roomID='".$id."' and dateNight='".$i."'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    $registros_encontrados = mysqli_num_rows($select2);
                    if($registros_encontrados == 0) {
                        $enableRoom='N';
                    }

                    $select2 = $this->db->query("select * from tb_roomRates where hotelID='".$hotelID."' and roomID='".$id."' and dateNight='".$i."' and enable='N'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    while ($row2 = $select2->fetch_assoc()) {
                        $enableRoom='N';
                    }

                    $reservadas = 0;

                    $select2 = $this->db->query("select * from tb_reserve_details where hotelID='".$hotelID."' and roomID='".$id."' and fecha_reserva='".$i."'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    while ($row2 = $select2->fetch_assoc()) {

                        $reservadas++;
                    }
                    $available_actual = $disonible_x_habitacion - $reservadas;

//-----
                    $insert =$this->db->query("INSERT INTO tb_values_comparison (valor) VALUES('".$available_actual."')")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    if ($reservadas >= $disonible_x_habitacion) {
                        $disponible = 'no';
                    }

                    if ($reservadas >= $disonible_x_habitacion) {
                        $available = 'no';
                    }

                }
            }

            $id = $row['roomID'];
            $enable = 'Y';

            $disonible_x_habitacion = $row['disponibles'];

            for ($i = $checkIn; $i <= $checkOut; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
                $reservadas = 0;

                $consulta2 = $this->db->query("select * from tb_reserve_details where hotelID='".$hotelID."' and roomID='".$id."' and fecha_reserva='".$i."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));
                while ($row2 = $consulta2->fetch_assoc()) {
                    $reservadas++;
                }
                if ($reservadas >= $disonible_x_habitacion) {
                    $enable = 'N';
                }

            }

            //-----
            $roomAvailablemin=0;
            $sel = $this->db->query("SELECT min(valor) AS valor FROM tb_values_comparison ")or die ("Couldn't execute query: ".mysqli_error($this->db));
            $sel_row = $sel->fetch_object();
            $roomAvailablemin = $sel_row->valor;

            if ($available == 'YES' and $available2 == 'YES' and $enableRoom=='Y') {

                $this->roomsDump[]=$row;
                $this->availableRoomsNo[]=$roomAvailablemin;
                $this->roomPrice[]=$price;
                $this->currency[]=$coin;
                $this->nightsNumber=$nights;
                $this->checkIn=$checkIn;
                $this->checkOut=$checkOut;
                $this->hotelID=$hotelID;

                $cont++;}
        }

        return $this->roomsDump;//Dump result

    }


}
?>






