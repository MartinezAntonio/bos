<?php
require_once('config.php');
$link=conect::conection();
// Primera comprobación. Cerraremos este if más adelante
if($_POST){
    // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
    $raw_post_data = file_get_contents('php://input');

    // Los separamos en un array
    $raw_post_array = explode('&',$raw_post_data);

    // Separamos cada uno en un array de variable y valor
    $myPost = array();
    foreach($raw_post_array as $keyval){
        $keyval = explode("=",$keyval);
        if(count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }

    // Nuestro string debe comenzar con cmd=_notify-validate
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')){
        $get_magic_quotes_exists = true;
    }
    foreach($myPost as $key => $value){
        // Cada valor se trata con urlencode para poder pasarlo por GET
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }

        //Añadimos cada variable y cada valor
        $req .= "&$key=$value";
    }
    $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');   // Esta URL debe variar dependiendo si usamos SandBox o no. Si lo usamos, se queda así.
    //$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');         // Si no usamos SandBox, debemos usar esta otra linea en su lugar.
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

    if( !($res = curl_exec($ch)) ) {
        // Ooops, error. Deberiamos guardarlo en algún log o base de datos para examinarlo después.
        curl_close($ch);
        exit;
    }
    curl_close($ch);

    if (strcmp ($res, "VERIFIED") == 0) {

        /*--------------------------------------------*/
        $payerEmail = $_POST['payer_email'];
        $payerName = $_POST['first_name'].' '.$_POST['last_name'];
        if($_POST["payment_status"]=='Completed'){
            //INSERT
            //$insert =$link->query("INSERT INTO prueba_paypal (estado) VALUES('".$_POST["invoice"]."')");
            $update = $link->query("UPDATE tb_reserve SET modeofpayment ='paypal',paid ='Y',status ='BOOKED',payerEmail ='".$payerEmail."',payerName ='".$payerName."' WHERE reserveID='".$_POST["invoice"]."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));
            //include('../../admin/senderMails.php');

            //senderMail('bookConfirmation',$payerEmail,'Antonio Martinez','0');//send email confirmation

            $roomsData=null;
            $guestEmail=null;
            $consulta = $link->query("select * from tb_reserve where reserveID='".$_POST["invoice"]."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));
            while ($row = $consulta->fetch_object()) {

                $arrival=$row->arrival;
                $departure=$row->departure;
                $invoice=$row->reserveID;
                $guestName=$row->guestName;
                $guestEmail=$row->guestEmail;
                $roomsExplode = explode("|", $row->roomID);
                $total=$row->total;
                $nights=$row->nights_no;

                for ($i = 0; $i <= count($row->roomID)+1; $i++) {//for

                    $consultaRooms = $link->query("select * from tb_rooms where roomID='".$roomsExplode[$i]."' ")or die ("Couldn't execute query: ".mysqli_error($this->db));
                    while ($rowRooms = $consultaRooms->fetch_assoc()) {

                        $roomsData[]=$rowRooms;

                    }


                }//for


            }




            /*********EMAIL**********/
            $destinatario = $guestEmail;
            $asunto = "Tabacon";
            $cuerpo = ' 
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="http://bos.cr/css/bookinngMailConfirm.css">
</head>



<body yahoo="" bgcolor="#f6f8f1">
<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td>
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
            <![endif]-->
            <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td bgcolor="#c7d8a7" class="header">

                        <!--[if (gte mso 9)|(IE)]>
                        <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0"
                               style="width: 100%; max-width: 425px;">
                            <tbody>
                            <tr>
                                <td class="innerpadding borderbottom">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="h2">
                                                <img class="fix" src="http://www.sevenstarsandstripes.com/newsletter/newsletter60/Tabacon-Logo-02.gif" width="200" border="0" alt="">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="h2">Thanks!<br>
                                                <span class="confirmed-text">Your reservation is confirmed.</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>

                <tr>
                    <td class="innerpadding borderbottom" style="background: whitesmoke;">

                        <!--[if (gte mso 9)|(IE)]>
                        <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="bodycopy">
                                                <p>See live updates to your itinerary, anywhere and anytime!</p>
                                                <a href="" target="_blank"><button class="button-itineray">See your itinerary</button></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Reservation Dates</b></h2>
                                                <p>'.$arrival.' - '.$departure.'</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Itinerary # '.$invoice.'</b></h2>
                                                <p>Get protection in case of last-minute cancellations or missed hotel nights</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Check-in and Check-out</b></h2>

                                                <p><b>Check-in time: </b>3:00 PM</p>
                                                <p><b>Check-out time: </b>11:00 AM</p><br>

                                                <p><b>Check-in policies:<br> </b>
                                                    Check-in time starts at 3:00 PM
                                                    Minimum check-in age is 21
                                                    Your room/unit will be guaranteed for late arrival
                                                </p>

                                                <hr>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Room/s</b></h2>

                                                <p><b>Guests</b></p>
                                                <p>
                                                    Reserved for '.$guestName.'<br>
                                                    2 adults , 1 child
                                                </p>
                                            </td>
                                        </tr>';






            foreach ($roomsData as $value){//foreach
                if($value['currency']=='USD'){
                    $coin='$';
                }else{
                    $coin='&cent;';
                }
                $cuerpo.='<tr>
                                            <td class="bodycopy">
                                                <div id="container">
                                                    <div id="div1">
                                                        <img src="http://bos.cr/img/rooms/'.$value['img1'].'" alt="Room" style="width: 100%">
                                                    </div>

                                                    <div id="div2">
                                                        <p>'.$value['name'].'</p><br>
                                                        <p>Price: '.$coin.$value['price'].'</p><br>
                                                        <p>Qty: 1</p><br>
                                                        <p><a href="" target="_blank"><button class="button-view-room">View room</button></a></p>
                                                    </div>
                                                </div>

                                                <hr>
                                            </td>
                                        </tr>';
            }//foreach






            $cuerpo.='
                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Price summary</b></h2>

                                                <p><b>Price breakdown</b></p>
                                                <p>
                                                    Room price $153.85<br>
                                                    '.$nights.' night/s: $67.85 avg./night<br>
                                                    7/13/2017 $27.60<br>
                                                    7/14/2017 $108.10<br>
                                                    Taxes and fees : $18.15<br>
                                                    <b>Total: '.$coin.$total.'</b>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Reservations and Cancelation Polices</b></h2>

                                                <p>
                                                    In order to guarantee your reservation, a 50% of the total amount must be paid at the moment of Booking other 50% must be prepaid 30 days before your arrival date; except when Booking online, where 100% of your Booking will be charged.<br>

                                                    - All cancelations requested 30 days or more before the arrival date, will be charged a 5% penalty for administrative expenses (from the total amount)<br>

                                                    - All cancelations requested 29 days prior to arrival will be charged 100% of the deposit.<br>

                                                    - In case of No shows, will be charged as follows:
                                                    Stays of 1 or 3 nights will be charge with a penalty of the 100%.
                                                    Stays of 4 nights or more will be charge with 2 nights penalty.
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>More help</b></h2>

                                                <p><b>About the Hotel</b></p>
                                                <p>
                                                    For special requests or questions about the property, please call the hotel<br> directly at
                                                    <a href="">+506 2479-2099</a>
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>



                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>

                <tr>
                    <td class="footer" bgcolor="#44525f">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center" class="footercopy">
                                    <a href="https://www.tabacon.com/" target="_blank" class="unsubscribe"><font color="#ffffff">Tabacon.com</font></a>
                                    <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    </tbody>
</table>


</body>
</html>
        ';

//para el envío en formato HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
//dirección del remitente
            $headers .= "From: Tabacon <info@tabacon.com>\r\n";
//direcciones que recibirán copia oculta
            $headers .= "Bcc: webdeveloper@profivirtual.com\r\n";

            mail($destinatario,$asunto,$cuerpo,$headers);
            /*********EMAIL**********/





        }


        /*--------------------------------------------*/

    } else if (strcmp ($res, "INVALID") == 0) {
// El estado que devuelve es INVALIDO, la información no ha sido enviada por PayPal. Deberías guardarla en un log para comprobarlo después
    }
} else {    // Si no hay datos $_POST
    // Podemos guardar la incidencia en un log, redirigir a una URL...
}
