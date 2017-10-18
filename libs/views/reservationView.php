<?php require "libs/models/setLangModel.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reservation | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">
    <!-- Alerts AlertifyJs-->
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">
    <script>
        //Auto on Slider (reservation.php)
        window.onload = function() {
            $('#myCarousel').find('.item').first().addClass('active');
            document.getElementById('myCarousel').style.display="block";
        };
    </script>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">

                            <section class="content invoice">

                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <button class="btn btn-success pull-right" onclick="history.back()"><i class="fa fa-reply"></i></button>
                                        <h1><?php echo $lang['reservation_details']?></h1>
                                        <h2 style="color: #26b99a"><i class="fa fa-calendar"></i> <b><?=$lang['Checkin']?>:</b> <?php echo $_POST['CheckIn_']?>   <b><?=$lang['Checkout']?>:</b> <?php echo $_POST['CheckOut_']?>  <b>(<?=$lang['nights']?>: <?php echo $nightsNumber ?>)</b> <br></h2>
                                    </div>
                                </div>

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table">

                                        <table id="table-summary">
                                            <thead>
                                            <tr class="tr-head-invoice">
                                                <th scope="col"><?=$lang['room']?></th>
                                                <th scope="col"><?=$lang['quantity']?></th>
                                                <th scope="col"><?=$lang['price']?></th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php
                                            $contArray=0;
                                            foreach ($roomsR as $row){?>
                                                <tr>
                                                    <td data-label="<?=$lang['room']?>"><?php echo $row['name'] ?></td>
                                                    <td data-label="<?=$lang['quantity']?>"><?php echo $roomsNo[$contArray] ?></td>
                                                    <td data-label="<?=$lang['price']?>"><?php echo $coin.number_format($price[$contArray], 2, '.', '') ?></td>
                                                    <td data-label="Subtotal"><?php echo $coin.number_format($subtotal[$contArray], 2, '.', '') ?></td>
                                                </tr>
                                                <?php $contArray++;} ?>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>


                                <hr>


                                <div class="container-numbers">

                                    <div class="div-numbers-1">

                                        <p class="lead">Amount Due <b style="color: #26b99a;">Today</b></p>

                                        <div class="table-responsive">
                                            <table class="table" id="amount-table">
                                                <tbody>
                                                <tr>
                                                    <th>Subtotal:</th>
                                                    <td><?php echo $coin.number_format($lastSubtotal, 2, '.', '')?></td>
                                                </tr>
                                                <tr>
                                                    <th><?=$lang['taxes']?>:</th>
                                                    <td><?php echo $coin.number_format($taxes, 2, '.', '')?></td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td><?php echo $coin.number_format($total, 2, '.', '')?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Large modal -->
                                        <div class="modal fade payment-modal" tabindex="-1" role="dialog" aria-hidden="true" id="payment-modal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel"><b><?=$lang['choose_paymet']?></b></h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="container-numbers">
                                                            <!-- accepted payments column -->

                                                            <div id="container">
                                                                <div id="div1">

                                                                    <div class="containerMethods">
                                                                        <input type="radio" name="paymentType" onclick="paymentMethod('creditCard')"> <span class="radioSpan"><?=$lang['credit_card']?></span>
                                                                        <input type="radio" name="paymentType" onclick="paymentMethod('paypal')"> <span class="radioSpan"><?=$lang['paypal_account']?></span>

                                                                        <img src="img/visa.png" alt="Visa">
                                                                        <img src="img/mastercard.png" alt="Mastercard">
                                                                        <img src="img/american-express.png" alt="American Express">
                                                                        <img src="img/paypal.png" alt="Paypal">
                                                                    </div>

                                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;" id="CreditCardMethod">

                                                                        <form class="form-horizontal form-label-left input_mask">

                                                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                                                <label for="">Credit card number</label>
                                                                                <input type="text" required class="form-control has-feedback-left" placeholder="Credit card number">
                                                                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                                                            </div>

                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Expiration</label> <small>(MM/YY)</small>
                                                                                <div class="input-group">
                                                                                    <select name="" required class="form-control" id="">
                                                                                        <option value=""></option>
                                                                                        <option value="01">01</option>
                                                                                        <option value="02">02</option>
                                                                                        <option value="03">03</option>
                                                                                        <option value="04">04</option>
                                                                                        <option value="05">05</option>
                                                                                        <option value="06">06</option>
                                                                                        <option value="07">07</option>
                                                                                        <option value="08">08</option>
                                                                                        <option value="09">09</option>
                                                                                        <option value="10">10</option>
                                                                                        <option value="11">11</option>
                                                                                        <option value="12">12</option>
                                                                                    </select>

                                                                                    <span class="input-group-addon">/</span>

                                                                                    <select name="" required class="form-control" id="">
                                                                                        <option value=""></option>
                                                                                        <option value="2017">17</option>
                                                                                        <option value="2018">18</option>
                                                                                        <option value="2019">19</option>
                                                                                        <option value="2020">20</option>
                                                                                        <option value="2021">21</option>
                                                                                        <option value="2022">22</option>
                                                                                        <option value="2023">23</option>
                                                                                        <option value="2024">24</option>
                                                                                        <option value="2025">25</option>
                                                                                        <option value="2026">26</option>
                                                                                        <option value="2027">27</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                                                <label for="">Security code</label>
                                                                                <input type="text" class="form-control has-feedback-left" placeholder="Security code">
                                                                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                                                                <label for="">Country</label>
                                                                                <select name="" required class="form-control" id="">
                                                                                    <option value="">Choose country</option>
                                                                                    <option value="USA">United States of America</option>
                                                                                    <option value="CHN">China</option>
                                                                                    <option value="DEU">Germany</option>
                                                                                    <option value="GBR">United Kingdom</option>
                                                                                    <option value="IND">India</option>
                                                                                    <option value="AFG">Afghanistan</option>
                                                                                    <option value="ALA">Åland</option>
                                                                                    <option value="ALB">Albania</option>
                                                                                    <option value="DZA">Algeria</option>
                                                                                    <option value="ASM">American Samoa</option>
                                                                                    <option value="AND">Andorra</option>
                                                                                    <option value="AGO">Angola</option>
                                                                                    <option value="AIA">Anguilla</option>
                                                                                    <option value="ATA">Antarctica</option>
                                                                                    <option value="ATG">Antigua and Barbuda</option>
                                                                                    <option value="ARG">Argentina</option>
                                                                                    <option value="ARM">Armenia</option>
                                                                                    <option value="ABW">Aruba</option>
                                                                                    <option value="AUS">Australia</option>
                                                                                    <option value="AUT">Austria</option>
                                                                                    <option value="AZE">Azerbaijan</option>
                                                                                    <option value="BHS">Bahamas</option>
                                                                                    <option value="BHR">Bahrain</option>
                                                                                    <option value="BGD">Bangladesh</option>
                                                                                    <option value="BRB">Barbados</option>
                                                                                    <option value="BLR">Belarus</option>
                                                                                    <option value="BEL">Belgium</option>
                                                                                    <option value="BLZ">Belize</option>
                                                                                    <option value="BEN">Benin</option>
                                                                                    <option value="BMU">Bermuda</option>
                                                                                    <option value="BTN">Bhutan</option>
                                                                                    <option value="BOL">Bolivia</option>
                                                                                    <option value="BIH">Bosnia and Herzegovina</option>
                                                                                    <option value="BWA">Botswana</option>
                                                                                    <option value="BVT">Bouvet Island</option>
                                                                                    <option value="BRA">Brazil</option>
                                                                                    <option value="IOT">British Indian Ocean Territory</option>
                                                                                    <option value="BRN">Brunei Darussalam</option>
                                                                                    <option value="BGR">Bulgaria</option>
                                                                                    <option value="BFA">Burkina Faso</option>
                                                                                    <option value="BDI">Burundi</option>
                                                                                    <option value="KHM">Cambodia</option>
                                                                                    <option value="CMR">Cameroon</option>
                                                                                    <option value="CAN">Canada</option>
                                                                                    <option value="CPV">Cape Verde</option>
                                                                                    <option value="CYM">Cayman Islands</option>
                                                                                    <option value="CAF">Central African Republic</option>
                                                                                    <option value="TCD">Chad</option>
                                                                                    <option value="CHL">Chile</option>
                                                                                    <option value="CHN">China</option>
                                                                                    <option value="CXR">Christmas Island</option>
                                                                                    <option value="CCK">Cocos (Keeling) Islands</option>
                                                                                    <option value="COL">Colombia</option>
                                                                                    <option value="COM">Comoros</option>
                                                                                    <option value="COG">Congo (Brazzaville)</option>
                                                                                    <option value="COD">Congo (Kinshasa)</option>
                                                                                    <option value="COK">Cook Islands</option>
                                                                                    <option value="CRI">Costa Rica</option>
                                                                                    <option value="CIV">Côte d'Ivoire</option>
                                                                                    <option value="HRV">Croatia</option>
                                                                                    <option value="CUB">Cuba</option>
                                                                                    <option value="CYP">Cyprus</option>
                                                                                    <option value="CZE">Czech Republic</option>
                                                                                    <option value="DNK">Denmark</option>
                                                                                    <option value="DJI">Djibouti</option>
                                                                                    <option value="DMA">Dominica</option>
                                                                                    <option value="DOM">Dominican Republic</option>
                                                                                    <option value="ECU">Ecuador</option>
                                                                                    <option value="EGY">Egypt</option>
                                                                                    <option value="SLV">El Salvador</option>
                                                                                    <option value="GNQ">Equatorial Guinea</option>
                                                                                    <option value="ERI">Eritrea</option>
                                                                                    <option value="EST">Estonia</option>
                                                                                    <option value="ETH">Ethiopia</option>
                                                                                    <option value="FLK">Falkland Islands</option>
                                                                                    <option value="FRO">Faroe Islands</option>
                                                                                    <option value="FJI">Fiji</option>
                                                                                    <option value="FIN">Finland</option>
                                                                                    <option value="FRA">France</option>
                                                                                    <option value="GUF">French Guiana</option>
                                                                                    <option value="PYF">French Polynesia</option>
                                                                                    <option value="ATF">French Southern Lands</option>
                                                                                    <option value="GAB">Gabon</option>
                                                                                    <option value="GMB">Gambia</option>
                                                                                    <option value="GEO">Georgia</option>
                                                                                    <option value="DEU">Germany</option>
                                                                                    <option value="GHA">Ghana</option>
                                                                                    <option value="GIB">Gibraltar</option>
                                                                                    <option value="GRC">Greece</option>
                                                                                    <option value="GRL">Greenland</option>
                                                                                    <option value="GRD">Grenada</option>
                                                                                    <option value="GLP">Guadeloupe</option>
                                                                                    <option value="GUM">Guam</option>
                                                                                    <option value="GTM">Guatemala</option>
                                                                                    <option value="GGY">Guernsey</option>
                                                                                    <option value="GIN">Guinea</option>
                                                                                    <option value="GNB">Guinea-Bissau</option>
                                                                                    <option value="GUY">Guyana</option>
                                                                                    <option value="HTI">Haiti</option>
                                                                                    <option value="HMD">Heard and McDonald Islands</option>
                                                                                    <option value="HND">Honduras</option>
                                                                                    <option value="HKG">Hong Kong</option>
                                                                                    <option value="HUN">Hungary</option>
                                                                                    <option value="ISL">Iceland</option>
                                                                                    <option value="IND">India</option>
                                                                                    <option value="IDN">Indonesia</option>
                                                                                    <option value="IRN">Iran</option>
                                                                                    <option value="IRQ">Iraq</option>
                                                                                    <option value="IRL">Ireland</option>
                                                                                    <option value="IMN">Isle of Man</option>
                                                                                    <option value="ISR">Israel</option>
                                                                                    <option value="ITA">Italy</option>
                                                                                    <option value="JAM">Jamaica</option>
                                                                                    <option value="JPN">Japan</option>
                                                                                    <option value="JEY">Jersey</option>
                                                                                    <option value="JOR">Jordan</option>
                                                                                    <option value="KAZ">Kazakhstan</option>
                                                                                    <option value="KEN">Kenya</option>
                                                                                    <option value="KIR">Kiribati</option>
                                                                                    <option value="PRK">Korea, North</option>
                                                                                    <option value="KOR">Korea, South</option>
                                                                                    <option value="KWT">Kuwait</option>
                                                                                    <option value="KGZ">Kyrgyzstan</option>
                                                                                    <option value="LAO">Laos</option>
                                                                                    <option value="LVA">Latvia</option>
                                                                                    <option value="LBN">Lebanon</option>
                                                                                    <option value="LSO">Lesotho</option>
                                                                                    <option value="LBR">Liberia</option>
                                                                                    <option value="LBY">Libya</option>
                                                                                    <option value="LIE">Liechtenstein</option>
                                                                                    <option value="LTU">Lithuania</option>
                                                                                    <option value="LUX">Luxembourg</option>
                                                                                    <option value="MAC">Macau</option>
                                                                                    <option value="MKD">Macedonia</option>
                                                                                    <option value="MDG">Madagascar</option>
                                                                                    <option value="MWI">Malawi</option>
                                                                                    <option value="MYS">Malaysia</option>
                                                                                    <option value="MDV">Maldives</option>
                                                                                    <option value="MLI">Mali</option>
                                                                                    <option value="MLT">Malta</option>
                                                                                    <option value="MHL">Marshall Islands</option>
                                                                                    <option value="MTQ">Martinique</option>
                                                                                    <option value="MRT">Mauritania</option>
                                                                                    <option value="MUS">Mauritius</option>
                                                                                    <option value="MYT">Mayotte</option>
                                                                                    <option value="MEX">Mexico</option>
                                                                                    <option value="FSM">Micronesia</option>
                                                                                    <option value="MDA">Moldova</option>
                                                                                    <option value="MCO">Monaco</option>
                                                                                    <option value="MNG">Mongolia</option>
                                                                                    <option value="MNE">Montenegro</option>
                                                                                    <option value="MSR">Montserrat</option>
                                                                                    <option value="MAR">Morocco</option>
                                                                                    <option value="MOZ">Mozambique</option>
                                                                                    <option value="MMR">Myanmar</option>
                                                                                    <option value="NAM">Namibia</option>
                                                                                    <option value="NRU">Nauru</option>
                                                                                    <option value="NPL">Nepal</option>
                                                                                    <option value="NLD">Netherlands</option>
                                                                                    <option value="ANT">Netherlands Antilles</option>
                                                                                    <option value="NCL">New Caledonia</option>
                                                                                    <option value="NZL">New Zealand</option>
                                                                                    <option value="NIC">Nicaragua</option>
                                                                                    <option value="NER">Niger</option>
                                                                                    <option value="NGA">Nigeria</option>
                                                                                    <option value="NIU">Niue</option>
                                                                                    <option value="NFK">Norfolk Island</option>
                                                                                    <option value="MNP">Northern Mariana Islands</option>
                                                                                    <option value="NOR">Norway</option>
                                                                                    <option value="OMN">Oman</option>
                                                                                    <option value="PAK">Pakistan</option>
                                                                                    <option value="PLW">Palau</option>
                                                                                    <option value="PSE">Palestine</option>
                                                                                    <option value="PAN">Panama</option>
                                                                                    <option value="PNG">Papua New Guinea</option>
                                                                                    <option value="PRY">Paraguay</option>
                                                                                    <option value="PER">Peru</option>
                                                                                    <option value="PHL">Philippines</option>
                                                                                    <option value="PCN">Pitcairn</option>
                                                                                    <option value="POL">Poland</option>
                                                                                    <option value="PRT">Portugal</option>
                                                                                    <option value="PRI">Puerto Rico</option>
                                                                                    <option value="QAT">Qatar</option>
                                                                                    <option value="REU">Reunion</option>
                                                                                    <option value="ROU">Romania</option>
                                                                                    <option value="RUS">Russian Federation</option>
                                                                                    <option value="RWA">Rwanda</option>
                                                                                    <option value="BLM">Saint Barthélemy</option>
                                                                                    <option value="SHN">Saint Helena</option>
                                                                                    <option value="KNA">Saint Kitts and Nevis</option>
                                                                                    <option value="LCA">Saint Lucia</option>
                                                                                    <option value="MAF">Saint Martin (French part)</option>
                                                                                    <option value="SPM">Saint Pierre and Miquelon</option>
                                                                                    <option value="VCT">Saint Vincent and the Grenadines</option>
                                                                                    <option value="WSM">Samoa</option>
                                                                                    <option value="SMR">San Marino</option>
                                                                                    <option value="STP">Sao Tome and Principe</option>
                                                                                    <option value="SAU">Saudi Arabia</option>
                                                                                    <option value="SEN">Senegal</option>
                                                                                    <option value="SRB">Serbia</option>
                                                                                    <option value="SYC">Seychelles</option>
                                                                                    <option value="SLE">Sierra Leone</option>
                                                                                    <option value="SGP">Singapore</option>
                                                                                    <option value="SVK">Slovakia</option>
                                                                                    <option value="SVN">Slovenia</option>
                                                                                    <option value="SLB">Solomon Islands</option>
                                                                                    <option value="SOM">Somalia</option>
                                                                                    <option value="ZAF">South Africa</option>
                                                                                    <option value="SGS">South Georgia and South Sandwich Islands</option>
                                                                                    <option value="ESP">Spain</option>
                                                                                    <option value="LKA">Sri Lanka</option>
                                                                                    <option value="SDN">Sudan</option>
                                                                                    <option value="SUR">Suriname</option>
                                                                                    <option value="SJM">Svalbard and Jan Mayen Islands</option>
                                                                                    <option value="SWZ">Swaziland</option>
                                                                                    <option value="SWE">Sweden</option>
                                                                                    <option value="CHE">Switzerland</option>
                                                                                    <option value="SYR">Syria</option>
                                                                                    <option value="TWN">Taiwan</option>
                                                                                    <option value="TJK">Tajikistan</option>
                                                                                    <option value="TZA">Tanzania</option>
                                                                                    <option value="THA">Thailand</option>
                                                                                    <option value="TLS">Timor-Leste</option>
                                                                                    <option value="TGO">Togo</option>
                                                                                    <option value="TKL">Tokelau</option>
                                                                                    <option value="TON">Tonga</option>
                                                                                    <option value="TTO">Trinidad and Tobago</option>
                                                                                    <option value="TUN">Tunisia</option>
                                                                                    <option value="TUR">Turkey</option>
                                                                                    <option value="TKM">Turkmenistan</option>
                                                                                    <option value="TCA">Turks and Caicos Islands</option>
                                                                                    <option value="TUV">Tuvalu</option>
                                                                                    <option value="UGA">Uganda</option>
                                                                                    <option value="UKR">Ukraine</option>
                                                                                    <option value="ARE">United Arab Emirates</option>
                                                                                    <option value="GBR">United Kingdom</option>
                                                                                    <option value="UMI">United States Minor Outlying Islands</option>
                                                                                    <option value="USA">United States of America</option>
                                                                                    <option value="URY">Uruguay</option>
                                                                                    <option value="UZB">Uzbekistan</option>
                                                                                    <option value="VUT">Vanuatu</option>
                                                                                    <option value="VAT">Vatican City</option>
                                                                                    <option value="VEN">Venezuela</option>
                                                                                    <option value="VNM">Vietnam</option>
                                                                                    <option value="VGB">Virgin Islands, British</option>
                                                                                    <option value="VIR">Virgin Islands, U.S.</option>
                                                                                    <option value="WLF">Wallis and Futuna Islands</option>
                                                                                    <option value="ESH">Western Sahara</option>
                                                                                    <option value="YEM">Yemen</option>
                                                                                    <option value="ZMB">Zambia</option>
                                                                                    <option value="ZWE">Zimbabwe</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="row no-print">
                                                                                    <div class="col-xs-12">
                                                                                        <div class="confirm-payment-box">
                                                                                            <p>
                                                                                                <?=$lang['charge_today']?><br>
                                                                                                <b><?php echo $coin.$total?></b>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <div class="row no-print">
                                                                                    <div class="col-xs-12">
                                                                                        <button class="btn btn-success pull-right"><i class="fa fa-credit-card" ></i> <?=$lang['submit_payment']?></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>



                                                                        </form>

                                                                    </div>
                                                                </div>

                                                                <!-------------------------->

                                                                <div id="div2">
                                                                    <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;" id="paypalMethod">

                                                                        <div class="form-group">
                                                                            <div class="row no-print">
                                                                                <div class="col-xs-12">
                                                                                    <div class="confirm-payment-box">
                                                                                        <p>
                                                                                            <?=$lang['charge_today']?><br>
                                                                                            <b><?php echo $coin.$total?></b>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                                                            <input type="hidden" name="cmd" value="_xclick">
                                                                            <input type="hidden" name="business" value="webdeveloper@profivirtual.com">
                                                                            <input type="hidden" name="upload" value="1">

                                                                            <input type="hidden" name="item_name" value="Reservation">
                                                                            <input type="hidden" name="quantity" value="1">
                                                                            <input type="hidden" name="amount" value="<?php echo $total ?>">

                                                                            <input type="hidden" name="currency_code" value="<?php echo $currency?>">
                                                                            <input type="hidden" name="no_shipping" value="1">
                                                                            <input type="hidden" name="return" value="http://bos.cr/?success">
                                                                            <input type="hidden" name="cancel_return" value="http://bos.cr/">
                                                                            <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>" >
                                                                            <input type="hidden" name="notify_url" id="notify_url" value="http://bos.cr/libs/models/ipnPaypalModel.php"/>
                                                                            <input type="image" src="img/pay-with-paypal.png" name="submit" style="width: 150px;margin-bottom: 8px">
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!--<div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>-->

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Large modal -->

                                        <p class="lead"><?=$lang['guest_info']?></p>


                                        <form id="userDataForm">
                                            
                                                <div class="input-group">
                                                    <input type="hidden" name="" id="reserveID" value="<?php echo $invoice?>">
                                                    <input type="text" class="form-control" name="firstname"  id="firstname" value="Antonio" placeholder="<?=$lang['firstname']?>" autocomplete="off" data-msg="Please enter your name">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control" name="lastname"  id="lastname" value="Martinez" placeholder="<?=$lang['lastname']?>" autocomplete="off" data-msg="Please enter your last name">
                                                </div>

                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="email"  id="email" value="coldentrevor@gmail.com" placeholder="<?=$lang['email']?>" autocomplete="off" data-msg="Please enter your email">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control" name="phone"  id="phone" value="60879429" placeholder="<?=$lang['phone']?>" autocomplete="off" data-msg="Please enter your phone">
                                                </div>

                                            <!--Cancellations polices-->
                                            <div class="panel-group" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" id="acc" onclick="scrollPolices()" href="#collapse"><li class="fa fa-angle-down"></li> <?=$lang['polices']?></a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <?php if($_SESSION['lang']=='es'){echo $hotelData["terminos"];}else{echo $hotelData["polices"];}?>
                                                            <div class="checkbox-polices">
                                                                <br>
                                                                <input type="checkbox" class="checkbox-polices" name="polices" id="polices" value="" data-msg="Please accept the terms"> <p><b><?=$lang['accept_terms']?></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Cancellations polices-->

                                            <button type="submit" id="submit-btn-payment" class="btn btn-success" onclick="$('#collapse').addClass('in');" style="width: 100%"><?=$lang['submit_payment']?></button>

                                        </form>


                                        <!-- Loader -->
                                        <div class="center" style="margin-top: 20px;">
                                            <div class="preloader" id="userDataLoader">
                                                <div class="circ1"></div>
                                                <div class="circ2"></div>
                                                <div class="circ3"></div>
                                                <div class="circ4"></div>
                                            </div>
                                        </div>
                                        <!-- Loader -->

                                    </div>

                                    <div class="div-numbers-2">
                                        <p class="lead"><?=$lang['accommodations']?></p>
                                        <!-- carousel -->
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" style="display: none">

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner">
                                                <?php foreach ($roomsR as $row){?>
                                                    <div class="item">
                                                        <img src="img/rooms/<?php echo $row['img1']?>" alt="" style="width:100%;">
                                                        <div class="carousel-caption">
                                                            <h3 class="stroke-black"><?php echo $row['name']?></h3>
                                                        </div>
                                                    </div>

                                                    <div class="item">
                                                        <img src="img/rooms/<?php echo $row['img2']?>" alt="" style="width:100%;">
                                                        <div class="carousel-caption">
                                                            <h3 class="stroke-black"><?php echo $row['name']?></h3>
                                                        </div>
                                                    </div>

                                                    <div class="item">
                                                        <img src="img/rooms/<?php echo $row['img3']?>" alt="" style="width:100%;">
                                                        <div class="carousel-caption">
                                                            <h3 class="stroke-black"><?php echo $row['name']?></h3>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <!-- carousel -->

                                    </div>
                                </div>


                                <!-- this row will not appear when printing -->
                                <div class="row no-print" id="down">
                                    <div class="col-xs-12"><br>
                                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

    </div>
</div>

<?php if($reservable==false){?>
    <script type="application/javascript">
        window.onload = function() {
            alertify.alert('Oops! <img src="http://bos.cr/img/sad.png" class="sad-face">', '<div class="alerts-container">We are sorry, the rooms you were trying to book have already been booked.<br><br> ¡Come on, Lets try it again! </div>',
                function(){
                    location.href ="http://bos.cr/";//redireccionamos al homepage
                });
        }
    </script>
<?php } ?>

<!-- jQuery -->





<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  type="text/javascript" src=" http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

        $('#userDataForm').validate({ // initialize the plugin
            rules: {
                firstname: {
                    required: true,
                    minlength: 3
                },
                lastname: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    minlength: 5,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 5,
                    number: true
                },
                polices: {
                    required: true
                }
            },
            submitHandler: function () {
                guestValidation();
            }
        });

    });
</script>


<!-- Bootstrap -->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- customjs -->
<script src="js/custom.js"></script>
<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

<!-- Alerts AlertifyJs-->
<script src="js/alertify.min.js"></script>

</body>
</html>