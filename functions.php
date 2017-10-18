<?php
require_once('libs/models/config.php');
//get hotel info
function getHotelInfo($name,$img,$website){
    $link=conect::conection();
    $consulta = $link->query("select * from tb_hotels where hotelID='".$_SESSION["hotelID"]."' ");
    while($row = $consulta->fetch_object()) {

        if($name=='true'){
            echo "<h1 class='hotel-title'>$row->nombre</h1>";
        }
        if($img=='true'){
            echo $row->wallpaper;
        }
        if($website=='true'){
            echo "<h2>$row->website</h2>";
        }

    }
    return true;
}

/*----*/

//get user info
$userDetails=$userClass->userDetails($session_user_id);

function getProfileImg(){
    $profileImg=0;
    if ($_SESSION["facebookID"] > 1){
        $profileImg='http://graph.facebook.com/'.$_SESSION["facebookID"].'/picture';
    }else{
        $link=conect::conection();
        $consulta = $link->query("select * from tb_user where userID='".$_SESSION['userID']."' ");
        while($row = $consulta->fetch_object()) {
            if($row->imgProfile==''){
                $profileImg="http://bos.cr/img/avatar.png";
            }else{
                $profileImg="http://bos.cr/img/profile/$row->imgProfile";
            }

        }

    }
    return $profileImg;
}

/*----*/

//get number of users
function getUsersqty($hotelID){
    $cont=0;
    $consulta=0;
    $link=conect::conection();

    $consulta2 = $link->query("select * from tb_hotels where hotelID='".$hotelID."' ");
    while($row2 = $consulta2->fetch_object()) {
        $hotelName= $row2->nombre;
    }

    if ($_SESSION['level']=='admin' or $_SESSION['level']=='reservation' ){
        //Trae la cantidad de usuarios de su hotel
        $consulta = $link->query("select * from tb_user where hotelID='".$_SESSION['hotelID']."' ");
    }
    if ($_SESSION['level']=='super user'){
        //trae toda la cantidad de usuarios en el 100% del sistema
        $consulta = $link->query("select * from tb_user where hotelID='".$hotelID."'");
    }
    while($row = $consulta->fetch_object()) {

        if($row->facebookID > 0){
            $fb='<li class="fa fa-facebook-f" title="User From Facebook"></li>';
        }

        if($row->enable=='Y'){
            $status='<button type="button" class="btn btn-success btn-xs">Enabled&nbsp;</button>';
        }else{
            $status='<button type="button" class="btn btn-danger btn-xs">Disabled</button>';
        }

        if($row->enable=='Y'){
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" checked data-switchery="true" style="display: none;">';
        }else{
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" data-switchery="true" style="display: none;">';
        }

        echo '
                                  <tr>
                                        <td>'.$row->userID.'</td>
                                        <td>
                                            <a>'.$row->name.'</a>
                                            <br/>
                                            <small>Created ('.$row->creationDate.')</small>
                                        </td>
                                        <td>
                                            <a>'.$hotelName.'</a>
                                        </td>
                                        <td class="project_progress">
                                           <a>'.$row->level.'</a>
                                        </td>
                                        <td>
                                           '.$status.'
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg'.$row->userID.'"><i class="fa fa-pencil"></i> Edit </a>
                                            <a class="btn btn-danger btn-xs" href="javascript:modifyUsers('.$row->userID.','.$_SESSION['userID'].')" ><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
    ';

        /*<!-- Large modal -->*/
        echo ' <div class="modal fade bs-example-modal-lg'.$row->userID.'" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

               <form class="form-horizontal form-label-left input_mask" method="post">
               <input type="hidden" name="updateUserID" value="'.$row->userID.'">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">'.$row->name.' '.$fb.'</h4>
                    </div>

                    <div class="modal-body">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Name</label>
                        <input type="text" value="'.$row->name.'" name="fullname" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Level</label>
                      <select type="text" name="level" class="form-control has-feedback-left" id="inputSuccess3">
                              <option value="'.$row->level.'">'.$row->level.'</option>
                              <option value="admin">Administrator</option>
                              <option value="reservation">Reservation</option>
                      </select>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Email</label>
                        <input type="text" value="'.$row->email.'" name="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Telephone</label>
                        <input type="text" value="'.$row->phone.'" name="phone" class="form-control" id="inputSuccess5" placeholder="Phone">
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>New Password</label>
                        <input type="text" value="" name="password" class="form-control" id="inputSuccess5" placeholder="New Password">
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       <label>Status</label>
                         '.$statusBtn.'
                      </div>
 
                      <div>
						  <br>
                      </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>

    </form>

                </div>
            </div>
        </div>
';
        /*<!-- Large modal -->*/

        $cont++;}
    return $cont;
}


/*----*/

//get number of users
function getRoomsqty(){
    $cont=0;
    $consulta=0;
    $link=conect::conection();

    if ($_SESSION['level']=='admin' or $_SESSION['level']=='reservation' ){
        //Trae la cantidad de usuarios de su hotel
        $consulta = $link->query("select * from tb_user where hotelID='".$_SESSION['hotelID']."' ");
    }
    if ($_SESSION['level']=='super user'){
        //trae toda la cantidad de usuarios en el 100% del sistema
        $consulta = $link->query("select * from tb_rooms");
    }
    while($row = $consulta->fetch_object()) {

        if($row->enable=='Y'){
            $status='<button type="button" class="btn btn-success btn-xs">Enabled&nbsp;</button>';
        }else{
            $status='<button type="button" class="btn btn-danger btn-xs">Disabled</button>';
        }

        if($row->enable=='Y'){
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" checked data-switchery="true" style="display: none;">';
        }else{
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" data-switchery="true" style="display: none;">';
        }

        echo '
                                  <tr>
                                   <td>  
                                            <a>'.$row->roomID.'</a>
                                        </td>
                                        <td>
                                            <a>'.$row->name.'</a>
                                            <br/>
                                            <small>Price '.$row->price.'</small>
                                        </td>
                                        <td>
                                            <a>'.$row->description.'</a>
                                        </td>
                                        <td class="project_progress">
                                           <a>'.$row->adults.'</a>
                                        </td>
                                        <td class="project_progress">
                                           <a>'.$row->children.'</a>/<br><a>'.$row->children_price.'</a>
                                        </td>
                                        <td>
                                           <a>'.$row->additional_person.'</a>/<br><a>'.$row->additional_person_price.'</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg'.$row->roomID.'"><i class="fa fa-pencil"></i> Edit </a>
                                            <a class="btn btn-danger btn-xs" href="javascript:modifyRooms('.$row->roomID.')" ><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
    ';

        /*<!-- Large modal -->*/
        echo ' <div class="modal fade bs-example-modal-lg'.$row->roomID.'" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

               <form class="form-horizontal form-label-left input_mask" method="post">
               <input type="hidden" name="updateRoomID" value="'.$row->roomID.'">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
                    </div>

                    <div class="modal-body">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Room name</label>
                        <input type="text" value="'.$row->name.'" name="name" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Description</label>

                        <textarea  class="form-control col-md-7 col-xs-12" name="description" rows="3">'.$row->description.'</textarea>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Adultos x habitacion</label>
                        <input type="text" value="'.$row->adults.'" name="adults" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Precio x habitacion</label>
                        <input type="text" value="'.$row->price.'" name="price" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Maximo de ni&ntilde;os</label>
                      <select type="text" name="children" class="form-control has-feedback-left" id="inputSuccess3">
                              <option value="'.$row->children.'">'.$row->children.'</option>
                              <option value="admin">Administrator</option>
                              <option value="reservation">Reservation</option>
                      </select>
                      </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Precio x ni&ntilde;o</label>
                        <input type="text" value="'.$row->children_price.'" name="children_price" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Maximo de personas adicionales</label>
                      <select type="text" name="additional_person" class="form-control has-feedback-left" id="inputSuccess3">
                              <option value="'.$row->additional_person.'">'.$row->additional_person.'</option>
                              <option value="admin">Administrator</option>
                              <option value="reservation">Reservation</option>
                      </select>
                      </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Precio x persona adicional</label>
                        <input type="text" value="'.$row->additional_person_price.'" name="additional_person_price" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Num d habita disponibles x noche</label>
                        <input type="text" value="'.$row->disponibles.'" name="disponibles" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                      </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Currency</label>
                      <select type="text" name="additional_person" class="form-control has-feedback-left" id="inputSuccess3">
                              <option value="'.$row->currency.'">'.$row->currency.'</option>
                              <option value="USD">USD</option>
                              <option value="&cent;">&cent;</option>
                      </select>
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       <label>Status</label>
                         '.$statusBtn.'
                      </div>

                      <div>
						  <br>
                      </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

    </form>

                </div>
            </div>
        </div>
';
        /*<!-- Large modal -->*/

        $cont++;}
    return $cont;
}


/*----*/

//get hotels
function getHotelsqty(){
    $cont=0;
    $consulta=0;
    $link=conect::conection();

    if ($_SESSION['level']=='admin' or $_SESSION['level']=='reservation' ){
        //Trae la cantidad de usuarios de su hotel
        $consulta = $link->query("select * from tb_hotels where hotelID='".$_SESSION['hotelID']."' ");
    }
    if ($_SESSION['level']=='super user'){
        //trae toda la cantidad de usuarios en el 100% del sistema
        $consulta = $link->query("select * from tb_hotels");
    }
    while($row = $consulta->fetch_object()) {

        if($row->enable=='Y'){
            $status='<button type="button" class="btn btn-success btn-xs">Enabled&nbsp;</button>';
        }else{
            $status='<button type="button" class="btn btn-danger btn-xs">Disabled</button>';
        }

        if($row->enable=='Y'){
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" checked data-switchery="true" style="display: none;">';
        }else{
            $statusBtn='<input type="checkbox" value="'.$row->enable.'" name="enable" class="js-switch" data-switchery="true" style="display: none;">';
        }

        echo '
                                  <tr>
                                        <td>'.$row->hotelID.'</td>
                                        <td>
                                            <a>'.$row->nombre.'</a>
                                            <br/>
                                            <small>Contact: '.$row->contacto.'</small>
                                        </td>
                                        <td>
                                            <a>'.$row->direccion.'</a>
                                        </td>
                                        <td class="project_progress">
                                           <a>'.$row->correo_1.'</a>
                                           <a>'.$row->tel_1.'</a>
                                        </td>
                                        <td>
                                           '.$status.'
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg'.$row->hotelID.'"><i class="fa fa-pencil"></i> Edit </a>
                                            <a class="btn btn-danger btn-xs" href="javascript:modifyHotels('.$row->hotelID.')" ><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
    ';

        /*<!-- Large modal -->*/
        echo ' <div class="modal fade bs-example-modal-lg'.$row->hotelID.'" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

               <form class="form-horizontal form-label-left input_mask" method="post">
               <input type="hidden" name="updateHotelID" value="'.$row->hotelID.'">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
                    </div>

                    <div class="modal-body">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Hotel name</label>
                        <input type="text" value="'.$row->nombre.'" name="name" class="form-control has-feedback-left" id="inputSuccess1" placeholder="Hotel name">
                      </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Hotel address</label>
                        <input type="text" value="'.$row->direccion.'" name="address" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Hotel address">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Contact name</label>
                        <input type="text" value="'.$row->contacto.'" name="contact" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Contact name">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Email</label>
                        <input type="text" value="'.$row->correo_1.'" name="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Telephone</label>
                        <input type="text" value="'.$row->tel_1.'" name="phone" class="form-control" id="inputSuccess5" placeholder="Phone">
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label>Website URL</label>
                        <input type="text" value="'.$row->website.'" name="website" class="form-control" id="inputSuccess6" placeholder="Website URL">
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                       <label>Status</label>
                         '.$statusBtn.'
                      </div>

                      <div>
						  <br>
                      </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>

    </form>

                </div>
            </div>
        </div>
';
        /*<!-- Large modal -->*/

        $cont++;}
    return $cont;
}


/*----*/

//get reserves
function getReserves($hotelID){
    $link=conect::conection();
    //Si el SU no tiene hotel y es SU mostrar todas las reservas
    if($_SESSION['hotelID']==0 and $_SESSION['level']=='super user'){
        $consulta = $link->query("select * from tb_reserve where hotelID='".$hotelID."' ");
    }else{
        //de lo contrario mostrar las reservas del hotel en sesion
        $consulta = $link->query("select * from tb_reserve where hotelID='".$_SESSION['hotelID']."' ");
    }
    while($row = $consulta->fetch_object()) {

        if($row->currency=='USD'){
            $coin='$';
        }else{
            $coin='&cent;';
        }

        $cadena = str_replace("|", " ", $row->roomID);
        $roomName = str_replace("|", " | ", $row->rooms_name);

        echo'
     <tr>
       <td><a href="#">'.$row->reserveID.'</a></td>
       <td>'.$roomName.'</td>
       <td>'.$row->payerName.'</td>
       <td>'.$row->days_no.'</td>
       <td>'.$row->arrival.'</td>
       <td>'.$row->departure.'</td>
       <td>'.$row->total.' '.$coin.'</td>
       <td>'.$row->status.'</td>
       <td>'.$row->modeofpayment.'</td>
     </tr>
        ';

    }

    return true;

}

//get rooms
function getRooms($hotelID){
    $link=conect::conection();
    echo '<option value="">-</option>';
    $consulta = $link->query("select * from tb_rooms WHERE hotelID='".$hotelID."' order by name asc ");
    while($row = $consulta->fetch_object()) {
        echo '<option value="'.$row->roomID.'" id="'.$row->roomID.'" name="'.$row->name.'">'.$row->name.'</option>';
    }
    return true;
}

/*----*/


//get hotels
function getHotels(){
    $link=conect::conection();
    echo '<option value="">-</option>';
    $consulta = $link->query("select * from tb_hotels WHERE enable='Y' order by nombre asc ");
    while($row = $consulta->fetch_object()) {
        echo '<option value="'.$row->hotelID.'" id="'.$row->hotelID.'" name="'.$row->nombre.'">'.$row->nombre.'</option>';
    }
    return true;
}

/*----*/

//name hotels
function nameHotels($hotelID){
    $link=conect::conection();
    $consulta = $link->query("select * from tb_hotels WHERE hotelID='".$hotelID."' ");
    while($row = $consulta->fetch_object()) {
        echo '<b>'.$row->nombre.'</b>';
    }
    return true;
}

/*----*/

//create users
function createUsers(){
    if (isset($_POST['createUsers'])){
        $currentDate=date('Y-m-d');
        $link=conect::conection();

        if ($_SESSION['level']=='super user'){
            $hotel=$_POST['hotel'];
        }else{
            $hotel=$_SESSION['hotelID'];
        }

        //verificamos existencia de usuario en bd
        $consulta = $link->query("select * from tb_user WHERE email='".$_POST['email']."'");
        while($row = $consulta->fetch_object()) {$email= $row->email;}

//si el usuario existe, mostrar alerta de error
        if(isset($email)){
            alerts('createUsers','error');
        }else{ //de lo contrario insertar usuario
            senderMail('createUsers',$_POST['email'],$_POST['fullname'],$_POST['password']);
            $passHash = md5($_POST['password']);//encriptamos password
            $insert = $link->query("INSERT INTO tb_user (hotelID,name,email,password,phone,level,enable,creationDate) VALUES('".$hotel."','".$_POST['fullname']."','".$_POST['email']."','".$passHash."','".$_POST['phone']."','".$_POST['level']."','Y','".$currentDate."')");
            alerts('createUsers','success');
        }

    }
    return false;
}


/*----*/


//delete users
function deleteUsers($deleteUser){

    if (isset($deleteUser)){

        $link=conect::conection();
        $delete=$link->query("DELETE FROM tb_user WHERE userID=$deleteUser");
        if ($delete==true){
            alerts('deleteUser','success');
        }

    }
    return true;

}

/*----*/


//update users
function updateUsers($updateUserID){
    if (isset($updateUserID)){
        $link=conect::conection();
        $consulta = $link->query("select * from tb_user where userID='".$updateUserID."' ");
        while($row = $consulta->fetch_object()) {
            $img= $row->imgProfile;
        }

        /*- UPLOAD IMAGES -*/
        if(basename($_FILES['file']['name'])!=''){
            $target_path1 = "../img/profile/";
            $target_path1 = $target_path1.basename($_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path1)) {
                $img=basename($_FILES['file']['name']);
            }
        }
        /*- UPLOAD IMAGES -*/

        if($_POST['enable']==''){$_POST['enable']='N';}else{$_POST['enable']='Y';}
        $passHash = md5($_POST['password']);//encriptamos password
        if(($_POST['password']=='')){$passHash=$_POST['passHashed'];}//si el usuario no cambia la contraseña entonces no encriptamos y guardamos la misma contraseña
        $update = $link->query("UPDATE tb_user SET name ='".$_POST['fullname']."',username ='".$_POST['username']."',email ='".$_POST['email']."',phone ='".$_POST['phone']."',enable ='".$_POST['enable']."',level ='".$_POST['level']."',password ='".$passHash."',imgProfile='".$img."' WHERE userID=$updateUserID ");
        if ($update==true){
            alerts('updateUser','success');
        }else{
            alerts('updateUser','error');
        }

    }
    return true;
}


/*----*/

//delete hotel
function deleteHotel($deleteHotel){

    if (isset($deleteHotel)){
        $link=conect::conection();
        $delete=$link->query("DELETE FROM tb_hotels WHERE hotelID=$deleteHotel");
        if ($delete==true){
            alerts('deleteHotel','success');
        }

    }
    return true;

}

//delete hotel
function deleteRoom($deleteRoom){

    if (isset($deleteRoom)){
        $link=conect::conection();
        $delete=$link->query("DELETE FROM tb_rooms WHERE roomID=$deleteRoom");
        if ($delete==true){
            alerts('deleteRoom','success');
        }

    }
    return true;

}




//update hotels
function updateHotels($updateHotelID){
    if (isset($updateHotelID)){
        $link=conect::conection();
        if($_POST['enable']==''){$_POST['enable']='N';}else{$_POST['enable']='Y';}
        $update = $link->query("UPDATE tb_hotels SET nombre ='".$_POST['name']."',direccion ='".$_POST['address']."',correo_1 ='".$_POST['email']."',tel_1 ='".$_POST['phone']."',enable ='".$_POST['enable']."',contacto ='".$_POST['contact']."',website ='".$_POST['website']."' WHERE hotelID=$updateHotelID ");
        if ($update==true){
            alerts('updateHotel','success');
        }
    }
    return true;
}

//fecha de mañana
$currentDate=date('Y-m-d');
$tomorrow= date( "Y-m-d", strtotime( "+1 day", strtotime( $currentDate ) ) );


/*----*/


//create Hotels
function createHotels(){
    if (isset($_POST['createHotels'])){
        $currentDate=date('Y-m-d');
        $link=conect::conection();

        //verificamos existencia de hotel en bd
        $consulta = $link->query("select * from tb_hotels WHERE correo_1='".$_POST['email']."'");
        while($row = $consulta->fetch_object()) {$email= $row->correo_1;}

        //si el hotel existe, mostrar alerta de error
        if(isset($email)){
            alerts('createHotels','error');
        }else{ //de lo contrario insertar hotel
            $insert = $link->query("INSERT INTO tb_hotels (nombre,direccion,contacto,tel_1,correo_1,enable,f_creacion,website) VALUES('".$_POST['name']."','".$_POST['address']."','".$_POST['contacname']."','".$_POST['phone']."','".$_POST['email']."','Y','".$currentDate."','".$_POST['website']."')");
            alerts('createHotels','success');
        }

    }
    return false;
}

/*----*/


/*----*/

//delete Rooms
function deleteRooms($deleteRoom){

    if (isset($deleteRoom)){
        $link=conect::conection();
        $delete=$link->query("DELETE FROM tb_rooms WHERE roomID=$deleteRoom");
        if ($delete==true){
            alerts('deleteRoom','success');
        }

    }
    return true;

}




//update hotels
function updateRooms($updateRoomID){
    if (isset($updateRoomID)){
        $link=conect::conection();
        $consulta = $link->query("select * from tb_rooms where roomID='".$updateRoomID."' ");
        while($row = $consulta->fetch_object()) {
            $img1= $row->img1;
            $img2= $row->img2;
            $img3= $row->img3;
        }

        /*- UPLOAD IMAGES -*/
        if(basename($_FILES['file1']['name'])!=''){
            $target_path1 = "../img/rooms/";
            $target_path1 = $target_path1.basename($_FILES['file1']['name']);
            if(move_uploaded_file($_FILES['file1']['tmp_name'], $target_path1)) {
                $img1=basename($_FILES['file1']['name']);
            }
        }

        if(basename($_FILES['file2']['name'])!=''){
            $target_path2 = "../img/rooms/";
            $target_path2 = $target_path2.basename($_FILES['file2']['name']);
            if(move_uploaded_file($_FILES['file2']['tmp_name'], $target_path2)) {
                $img2=basename($_FILES['file2']['name']);
            }
        }

        if(basename($_FILES['file3']['name'])!=''){
            $target_path3 = "../img/rooms/";
            $target_path3 = $target_path3.basename($_FILES['file3']['name']);
            if(move_uploaded_file($_FILES['file3']['tmp_name'], $target_path3)) {
                $img3=basename($_FILES['file3']['name']);
            }
        }
        /*- UPLOAD IMAGES -*/


        //calculos
        $totalTaxes= $_POST['price']*$_POST['taxes']/100;//impuesto
        $priceandTaxes= $_POST['price']+$totalTaxes;//precio mas impuesto
        //btn status
        if($_POST['enable']==''){$_POST['enable']='N';}else{$_POST['enable']='Y';}

        //update
        $update = $link->query("UPDATE tb_rooms SET 
        name ='".$_POST['name']."',
        disponibles ='".$_POST['disponibles']."',
        roomType ='".$_POST['name']."',
        description ='".$_POST['description']."',
        img1 ='".$img1."',
        img2 ='".$img2."',
        img3 ='".$img3."',
        adults ='".$_POST['adults']."',
        price ='".$_POST['price']."',
        priceandTaxes ='".$priceandTaxes."',
        taxes ='".$_POST['taxes']."',
        totalTaxes ='".$totalTaxes."',
        children ='".$_POST['children']."',
        children_price ='".$_POST['children_price']."',
        additional_person ='".$_POST['additional_person']."',
        additional_person_price ='".$_POST['additional_person_price']."',
        disponibles ='".$_POST['disponibles']."',
        currency ='".$_POST['currency']."',
        enable ='".$_POST['enable']."',
        tv ='".$_POST['tv']."',
        wifi ='".$_POST['wifi']."',
        kitchen ='".$_POST['kitchen']."',
        jacuzzi='".$_POST['jacuzzi']."',
        pets ='".$_POST['pets']."',
        air ='".$_POST['air']."'
        WHERE roomID=$updateRoomID ");

        if ($update==true){
            alerts('updateRoom','success');
        }
    }
    return true;
}

//fecha de mañana
$currentDate=date('Y-m-d');
$tomorrow= date( "Y-m-d", strtotime( "+1 day", strtotime( $currentDate ) ) );


/*----*/


//create Hotels
function createRooms(){

    if (isset($_POST['createRooms'])){


        /*- UPLOAD IMAGES -*/

        $target_path1 = "../img/rooms/";
        $target_path1 = $target_path1.basename($_FILES['file1']['name']);
        if(move_uploaded_file($_FILES['file1']['tmp_name'], $target_path1)) {
            $img1=basename($_FILES['file1']['name']);
        }

        $target_path2 = "../img/rooms/";
        $target_path2 = $target_path2.basename($_FILES['file2']['name']);
        if(move_uploaded_file($_FILES['file2']['tmp_name'], $target_path2)) {
            $img2=basename($_FILES['file2']['name']);
        }

        $target_path3 = "../img/rooms/";
        $target_path3 = $target_path3.basename($_FILES['file3']['name']);
        if(move_uploaded_file($_FILES['file3']['tmp_name'], $target_path3)) {
            $img3=basename($_FILES['file3']['name']);
        }

        /*- UPLOAD IMAGES -*/

        //calculos
        $totalTaxes= $_POST['price']*$_POST['taxes']/100;//impuesto
        $priceandTaxes= $_POST['price']+$totalTaxes;//precio mas impuesto
        //btn status
        if($_POST['enable']==''){$_POST['enable']='N';}else{$_POST['enable']='Y';}



        if ($_SESSION['level']=='super user'){
            $hotel=$_POST['hotel'];
        }else{
            $hotel=$_SESSION['hotelID'];
        }
        $link=conect::conection();
        $insert = $link->query("INSERT INTO tb_rooms (hotelID,name,price,priceandTaxes,taxes,totalTaxes,adults,children,beds,disponibles,currency,wifi,air,kitchen,pets,jacuzzi,description,img1,img2,img3) VALUES('".$hotel."','".$_POST['roomName']."','".$_POST['price']."','".$priceandTaxes."','".$_POST['taxes']."','".$totalTaxes."','".$_POST['adults']."','".$_POST['children']."','".$_POST['beds']."','".$_POST['disponibles']."','".$_POST['currency']."','".$_POST['wifi']."','".$_POST['air']."','".$_POST['kitchen']."','".$_POST['pets']."','".$_POST['jacuzzi']."','".$_POST['description']."','".$img1."','".$img2."','".$img3."')");
        if ($insert==true){
            alerts('createRooms','success');
        }

    }
    return false;
}

/*----*/



function porcentaje($total, $parte, $redondear = 0) {
    return round($parte / $total * 100, $redondear);
}

function calcPorcentUsers(){
    $link=conect::conection();
    $fbUsers=0;
    $normalUsers=0;
    $consulta = $link->query("select * from tb_user where level='user' and enable='Y'");
    while($row = $consulta->fetch_object()) {

        if($row->facebookID > 0){
            $fbUsers++;
        }else{
            $normalUsers++;
        }
    }

    $total = $fbUsers+$normalUsers;

    echo '<input type="hidden" id="DataFacebookUsers" value="'.porcentaje($total, $fbUsers, 0).'">';
    echo '<input type="hidden" id="DataNormalUsers" value="'.porcentaje($total, $normalUsers, 0).'">';
}


/*----*/


//create Add Ons
function createAddOns(){

    if (isset($_POST['createAddOns'])){
        $link=conect::conection();

        /*- UPLOAD IMAGES -*/

        $target_path1 = "../img/addons/";
        $target_path1 = $target_path1.basename($_FILES['file1']['name']);
        if(move_uploaded_file($_FILES['file1']['tmp_name'], $target_path1)) {
            $img1=basename($_FILES['file1']['name']);
        }

        $target_path2 = "../img/addons/";
        $target_path2 = $target_path2.basename($_FILES['file2']['name']);
        if(move_uploaded_file($_FILES['file2']['tmp_name'], $target_path2)) {
            $img2=basename($_FILES['file2']['name']);
        }

        $target_path3 = "../img/addons/";
        $target_path3 = $target_path3.basename($_FILES['file3']['name']);
        if(move_uploaded_file($_FILES['file3']['tmp_name'], $target_path3)) {
            $img3=basename($_FILES['file3']['name']);
        }
        /*- UPLOAD IMAGES -*/

        if ($_SESSION['level']=='super user'){
            $hotel=$_POST['hotel'];
        }else{
            $hotel=$_SESSION['hotelID'];
        }

        $currentDate=date('Y-m-d');
        $insert = $link->query("INSERT INTO tb_add_ons (hotelID,nameAddOns,description,currency,price,status,creationDate,creationUser,img1,img2,img3) VALUES('".$hotel."','".$_POST['nameAddOns']."','".$_POST['description']."','".$_POST['currency']."','".$_POST['price']."','Y','".$currentDate."','Antonio Martinez','".$img1."','".$img2."','".$img3."')");
        if ($insert==true){
            alerts('createAddOns','success');
        }

    }
    return false;
}


//update Add Ons
function updateAddOns($updateaddonsID){
    if (isset($updateaddonsID)){
        $link=conect::conection();
        $consulta = $link->query("select * from tb_add_ons where addonsID='".$updateaddonsID."' ");
        while($row = $consulta->fetch_object()) {
            $img1= $row->img1;
            $img2= $row->img2;
            $img3= $row->img3;
        }

        /*- UPLOAD IMAGES -*/
        if(basename($_FILES['file1']['name'])!=''){
            $target_path1 = "../img/addons/";
            $target_path1 = $target_path1.basename($_FILES['file1']['name']);
            if(move_uploaded_file($_FILES['file1']['tmp_name'], $target_path1)) {
                $img1=basename($_FILES['file1']['name']);
            }
        }

        if(basename($_FILES['file2']['name'])!=''){
            $target_path2 = "../img/addons/";
            $target_path2 = $target_path2.basename($_FILES['file2']['name']);
            if(move_uploaded_file($_FILES['file2']['tmp_name'], $target_path2)) {
                $img2=basename($_FILES['file2']['name']);
            }
        }

        if(basename($_FILES['file3']['name'])!=''){
            $target_path3 = "../img/addons/";
            $target_path3 = $target_path3.basename($_FILES['file3']['name']);
            if(move_uploaded_file($_FILES['file3']['tmp_name'], $target_path3)) {
                $img3=basename($_FILES['file3']['name']);
            }
        }
        /*- UPLOAD IMAGES -*/


        //btn status
        if($_POST['enable']==''){$_POST['enable']='N';}else{$_POST['enable']='Y';}

        //update
        $update = $link->query("UPDATE tb_add_ons SET
        nameAddOns ='".$_POST['nameAddOns']."',
        description ='".$_POST['description']."',
        price ='".$_POST['price']."',
        img1 ='".$img1."',
        img2 ='".$img2."',
        img3 ='".$img3."',
        status ='".$_POST['enable']."',
        currency ='".$_POST['currency']."'
        WHERE addonsID=$updateaddonsID ");

        if ($update==true){
            alerts('updateAddOns','success');
        }
    }
    return true;
}

/*----*/


/*----*/

//delete Rooms
function deleteAddOns($deleteAddOns){

    if (isset($deleteAddOns)){
        $link=conect::conection();
        $delete=$link->query("DELETE FROM tb_add_ons WHERE addonsID=$deleteAddOns");
        if ($delete==true){
            alerts('deleteAddOns','success');
        }

    }
    return true;

}


?>
