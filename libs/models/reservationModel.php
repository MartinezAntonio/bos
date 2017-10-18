<?php
class reservationModel{

    private $db;
    public $roomsDumpR;
    public $roomsNo;
    public $coin;
    public $currency;
    public $subtotal;
    public $lastSubtotal;
    public $nightsNumber;
    public $taxes;
    public $total;
    public $roomIDs;
    public $price;
    public $hotelData;

    public function __construct(){

        require_once('libs/models/config.php');
        $this->db=conect::conection();
        $this->roomsDumpR=array();
        $this->roomsNo=array();
        $this->coin=0;
        $this->subtotal=array();
        $this->lastSubtotal=0;
        $this->nightsNumber=0;
        $this->taxes=0;
        $this->total=0;
        $this->currency=0;
        $this->roomIDs=array();
        $this->price=array();
        $this->hotelData=0;

    }

    public function getRoomsR($hotelID,$CheckIn_,$CheckOut_){

        /*-- --*/
        $start_ts=strtotime($CheckIn_);
        $end_ts=strtotime($CheckOut_);
        $result_dateCalculation = $end_ts - $start_ts;
        $nights=round($result_dateCalculation / 86400);
        /*-- --*/

        $subtotalSum=0;
        $taxesSum=0;
        $conter = 0;
        $price=0;
        $consulta = $this->db->query("select * from tb_rooms where hotelID='".$hotelID."' and enable='Y' order by category_id ASC")or die ("Couldn't execute query: ".mysqli_error($this->db));
        while ($rowR = $consulta->fetch_assoc()) {

            if ($_POST['roomID'.$rowR['roomID']] > 0) {//the conditional only filters the existing variables in post

                for ($i = $CheckIn_; $i < $CheckOut_; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {//for

                    $select2 = $this->db->query("select * from tb_roomRates where hotelID='".$hotelID."' and roomID='".$rowR['roomID']."' and dateNight='".$i."' and enable='Y'")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    while ($row2 = $select2->fetch_assoc()) {

                        if ($row2['taxes']>0){
                            $price= $price+($row2['price']+($row2['price']*($rowR['taxes']/100)));
                        } else {
                            $price= $row2['price'];
                        }
                        $taxesSum=$taxesSum+$row2['price']*($rowR['taxes']/100)*$_POST['roomID'.$rowR['roomID']];
                        $this->taxes=$taxesSum;
                    }


                }//for


                $this->price[]=$price;
                $this->roomsDumpR[]=$rowR;
                $this->nightsNumber=$nights;
                $this->roomsNo[]=$_POST['roomID'.$rowR['roomID']];
                $this->subtotal[]=$price*$_POST['roomID'.$rowR['roomID']]*$nights;

                if($rowR['currency']=='USD'){$coin='$';}else{$coin='&cent;';}
                $this->coin=$coin;
                $this->currency=$rowR['currency'];

                $subtotalSum=$subtotalSum+$price*$_POST['roomID'.$rowR['roomID']]*$nights;
                $this->lastSubtotal=$subtotalSum;

                $this->total=$subtotalSum+$taxesSum;

                $this->roomIDs[]=$rowR['roomID'];

        }//if

        }

        $consultaz = $this->db->query("select * from tb_hotels where hotelID='".$hotelID."' and enable='Y' ")or die ("Couldn't execute query: ".mysqli_error($this->db));
        while ($rowz = $consultaz->fetch_assoc()) {
            $this->hotelData=$rowz;
        }

        return $this->roomsDumpR;//Dump result
    }


}
?>






