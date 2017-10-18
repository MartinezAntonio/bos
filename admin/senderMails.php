<?php
function senderMail($mailType,$userEmail,$Name,$password){

    if ($mailType=='createUsers'){

    $destinatario = $userEmail;
    $asunto = "Booking System - Profimercadeo";
    $cuerpo = ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>A Simple Responsive HTML Email</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            min-width: 100% !important;
        }

        img {
            height: auto;
        }

        .content {
            width: 100%;
            max-width: 600px;
        }

        .header {
            padding: 0 20px 10px 0;
            background-color: #18bc9c !important;
        }

        .innerpadding {
            padding: 30px 30px 30px 35px;
        }

        .borderbottom {
            border-bottom: 1px solid #f2eeed;
        }

        .subhead {
            font-size: 15px;
            color: #ffffff;
            font-family: sans-serif;
            letter-spacing: 10px;
        }

        .h1, .h2, .bodycopy {
            color: #153643;
            font-family: sans-serif;
        }

        .h1 {
            font-size: 33px;
            line-height: 38px;
            font-weight: bold;
        }

        .h2 {
            padding: 0 0 15px 0;
            font-size: 24px;
            line-height: 28px;
            font-weight: bold;
        }

        .bodycopy {
            font-size: 16px;
            line-height: 22px;
        }

        .button {
            text-align: center;
            font-size: 18px;
            font-family: sans-serif;
            font-weight: bold;
            padding: 0 30px 0 30px;
        }

        .button a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            padding: 20px 30px 15px 30px;
        }

        .footercopy {
            font-family: sans-serif;
            font-size: 14px;
            color: #ffffff;
        }

        .footercopy a {
            color: #ffffff;
            text-decoration: underline;
        }

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none !important;
            }

            body[yahoo] .buttonwrapper {
                background-color: transparent !important;
            }

            body[yahoo] .button {
                padding: 0px !important;
            }

            body[yahoo] .button a {
                background-color: #e05443;
                padding: 15px 15px 13px !important;
            }

            body[yahoo] .unsubscribe {
                display: block;
                margin-top: 20px;
                padding: 10px 50px;
                background: #2f3942;
                border-radius: 5px;
                text-decoration: none !important;
                font-weight: bold;
            }
        }

        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

    </style>
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
                                <td height="10">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="h1" style="padding: 5px 0 0 0;">
                                                <img class="fix" src="http://www.profimercadeo.com/images/logo_profimercadeo.png" width="200" border="0" alt="">
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
                    <td class="innerpadding borderbottom">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>   
                                <td class="h2">
                                    Welcome!
                                </td> 
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding borderbottom">
                        <table width="115" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td height="115" style="padding: 0 20px 20px 0;">
                                    <img class="fix" src="http://bos.cr/img/candado.png" width="115" height="115" border="0"
                                         alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0"
                               style="width: 100%; max-width: 380px;">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="bodycopy">
                                               Hi '.$Name.' these are your system login credentials<br>
                                               for the Booking System:<br><br>
                                               
                                               <b>Email:</b> '.$userEmail.'<br>
                                               <b>Password:</b> '.$password.'
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 20px 0 0 0;">
                                                <table class="buttonwrapper" bgcolor="#26b99a" border="0"
                                                       cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                    <tr>
                                                        <td class="button" height="45">
                                                            <a href="http://bos.cr/admin/">Login</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
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
                                   <!-- © Developed by
                                    <a href="http://www.profimercadeo.com" class="unsubscribe"><font color="#ffffff">Profimercadeo</font></a>-->
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
    $headers .= "From: Profimercadeo <info@profimercadeo.com>\r\n";
//direcciones que recibirán copia oculta
    $headers .= "Bcc: webdeveloper@profivirtual.com\r\n";

    mail($destinatario,$asunto,$cuerpo,$headers);

}






/*-------------------*/





    if ($mailType=='bookConfirmation'){

        $destinatario = $userEmail;
        $asunto = "Tabacon";
        $cuerpo = ' 
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Booking Confirmation</title>
    <style type="text/css">
        @font-face {
            font-family: "Questrial";
            src: url(vendor/font-awesome/fonts/Questrial-Regular.ttf) format("truetype");
        }
        body {
            font-family: Questrial, sans-serif;
            margin: 0;
            padding: 0;
            min-width: 100% !important;
        }

        img {
            height: auto;
        }

        .content {
            width: 100%;
            max-width: 600px;
        }

        .header {
            padding: 0 20px 0 0;
            background-color: white !important;
        }

        .innerpadding {
            padding: 30px 30px 30px 35px;
        }

        .borderbottom {

        }

        .subhead {
            font-size: 15px;
            color: #ffffff;
            font-family: Questrial, sans-serif;
            letter-spacing: 10px;
        }

        .h1, .h2, .bodycopy {
            color: #153643;
            font-family: Questrial, sans-serif;
        }
        .spaces{
            margin-bottom: 8px;
        }
        p{
            margin: 0;
        }
        .h1 {
            font-size: 33px;
            line-height: 38px;
            font-weight: bold;
        }

        .h2 {
            padding: 0 0 15px 0;
            font-size: 24px;
            line-height: 28px;
            font-weight: bold;
        }

        .bodycopy {
            font-size: 16px;
            line-height: 22px;
            padding-top: 10px;
        }

        .button {
            text-align: center;
            font-size: 18px;
            font-family: Questrial, sans-serif;
            font-weight: bold;
            padding: 0 30px 0 30px;
        }

        .button a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            padding: 20px 30px 15px 30px;
        }

        .footercopy {
            font-family: Questrial, sans-serif;
            font-size: 14px;
            color: #ffffff;
        }

        .footercopy a {
            color: #ffffff;
            text-decoration: underline;
        }

        .confirmed-text{
            color: #28a745;
        }

        .button-itineray{
            width: 100%;
            background-color: #26B99A;
            padding: 10px;
            border: none;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .button-view-room{
            border: none;
            padding: 5px;
            width: 100px;
            color: white;
            background-color: #26b99a;
            font-weight: 600;
            cursor: pointer;
        }

        #container{
            width:100%;
            margin:auto;
            display: table;
        }
        #div1{
            width:50%;
            display:inline-block;
            vertical-align: middle;
        }
        #div2{
            width:40%;
            display:inline-block;
            vertical-align: middle;
            padding-left: 10px;
        }

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none !important;
            }

            body[yahoo] .buttonwrapper {
                background-color: transparent !important;
            }

            body[yahoo] .button {
                padding: 0px !important;
            }

            body[yahoo] .button a {
                background-color: #e05443;
                padding: 15px 15px 13px !important;
            }

            body[yahoo] .unsubscribe {
                display: block;
                margin-top: 20px;
                padding: 10px 50px;
                background: #2f3942;
                border-radius: 5px;
                text-decoration: none !important;
                font-weight: bold;
            }
        }

        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

    </style>
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
                                                <p>'.date('M d, Y').' - '.date('M d, Y').'</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Itinerary #</b></h2>
                                                <p>7272401882018</p>
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
                                                    Reserved for '.$Name.'<br>
                                                    2 adults , 1 child
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <div id="container">
                                                    <div id="div1">
                                                        <img src="http://bos.cr/img/rooms/honeymoon2.jpg" alt="Room" style="width: 100%">
                                                    </div>

                                                    <div id="div2">
                                                        <p>Honeymoon Suite</p><br>
                                                        <p>Price: $100</p><br>
                                                        <p>Qty: 1</p><br>
                                                        <p><a href="" target="_blank"><button class="button-view-room">View room</button></a></p>
                                                    </div>
                                                </div>

                                                <hr>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bodycopy">
                                                <h2><b>Price summary</b></h2>

                                                <p><b>Price breakdown</b></p>
                                                <p>
                                                    Room price $153.85<br>
                                                    2 nights: $67.85 avg./night<br>
                                                    7/13/2017 $27.60<br>
                                                    7/14/2017 $108.10<br>
                                                    Taxes and fees : $18.15<br>
                                                    <b>Total: $1000</b>
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

    }





}
?>