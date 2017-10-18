
/* BEING AJAX OBJECT PROCESSOR*/
function objetoAjax(){
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {

        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false; }
    }

    if (!xmlhttp && typeof XMLHttpRequest!=='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
/* END AJAX OBJECT PROCESSOR*/




/* BEING SEARCH ENGINE CORE */
function enviarDatos(){

    //check data
    if($('#CheckIn').val()!=='' && $('#CheckOut').val()!==''){

        //muestro loader
        $('#engineLoader').show().fadeIn(1000);

        //Recogemos los valores introducimos en los campos de texto
        start = document.sentMessage.start.value;
        end = document.sentMessage.end.value;
        hotelID = document.sentMessage.hotelID.value;

//Aqui seri donde se mostrara el resultado
        resultado = document.getElementById('resultado');

//instanciamos el objetoAjax
        ajax = objetoAjax();

//Abrimos una conexion AJAX
        ajax.open("POST", "libs/controllers/bookEngineController.php", true);

//cuando el objeto XMLHttpRequest cambia de estado, la funcion se inicia
        ajax.onreadystatechange = function() {

//Cuando se completa la peticion, mostrara los resultados
            if (ajax.readyState === 4){

//El mtodo responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
                resultado.innerHTML = (ajax.responseText);

                //oculto loader
                $('#engineLoader').hide().fadeOut(1000);

                //scroll down section rooms
                $('html,body').animate({scrollTop: $("#resultado").offset().top}, 1000);

            }
        };

//Llamamos al mitodo setRequestHeader indicando que los datos a enviarse eston codificados como un formulario.
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

//enviamos las variables a 'consulta.php'
        ajax.send("&start="+start+"&end="+end+"&hotelID="+hotelID);


    }//check data


}
/* END SEARCH ENGINE CORE */




/* BEING DATA SENDER LOGIN FORMS */
function enviarDatosFormLogin(openUrl){

    //muestro loader
    $('#loginLoader').show();

    //Recogemos los valores introducimos (LOGIN FORM)
    username = document.loginForm.username.value;
    password = document.loginForm.password.value;
    loginSubmit = document.loginForm.loginSubmit.value;
    bookLink = $('#bookLink').attr('href');

    //Aquí será donde se mostrará el resultado
    resultadoForm = document.getElementById('errorMsgLogin');

    //instanciamos el objetoAjax
    ajax = objetoAjax();
    //Abrimos una conexión AJAX
      ajax.open("POST",openUrl, true);

    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    ajax.onreadystatechange = function() {

        //Cuando se completa la petición, mostrará los resultados
        if (ajax.readyState === 4){
            //El método responseText() contiene el texto de nuestro 'loginCheck.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
            resultadoForm.innerHTML = (ajax.responseText);

            /*si el nivel del usuario y este es un nivel de usuario interno,
             iniciar sesion y redireccionar al dashboard dentro de la subcarpeta /admin*/
            if (resultadoForm.innerText === "super user" || resultadoForm.innerText === "admin" || resultadoForm.innerText === "reservation"){
                //vaciamos resultado para que no sea mostrador
                resultadoForm.innerHTML = '';
                //Si es super user o de administracion o de reservaciones lo redireccionamos al dashboard dentro de la subcarpeta /admin
                window.location="http://bos.cr/admin/home.php";

            }else{

                //si el nivel del usuario es "user" redireccionar a reservations.php
                if (resultadoForm.innerText === "user"){

                    //vaciamos resultado para que no sea mostrado
                    resultadoForm.innerHTML = '';
                    //Si el login de usuario se hace desde el login de admin redireccionar al index
                    if(bookLink === null){
                        window.location="http://bos.cr/home.php";
                    }else{
                        window.location=bookLink;
                    }
                    //redireccionamos al usuario junto con los datos de la reserva

                }
            }

            //si los datos son erroneos
            if (resultadoForm.innerText === "error"){
                //oculto loader
                $('#loginLoader').hide().fadeOut(1000);
                //mostramos mensaje de error
                resultadoForm.innerHTML = ('¡ Please check your login details !');
                //mostramos div del mensaje lentamente
                $('#errorMsgLogin').show().fadeIn(1000);
                //mostramos opcion de recuperacion de cuenta
                $('#accountRecovery1').show();
            }

        }
    };

    //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un loginForm.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviamos las variables a 'loginCheck.php'
    ajax.send("&username="+username+"&password="+password+"&loginSubmit="+loginSubmit);


}
/*--------------------*/

function enviarDatosFormSingup(){

    //muestro loader
    $('#singupLoader').show();

    //Recogemos los valores introducimos (SINGUP FORM)
    nameReg = document.signup.nameReg.value;
    lastName = document.signup.lastName.value;
    emailReg = document.signup.emailReg.value;
    passwordReg = document.signup.passwordReg.value;
    signupSubmit = document.signup.signupSubmit.value;
    bookLink = $('#bookLink').attr('href');

    //Aquí será donde se mostrará el resultado
    resultadoForm = document.getElementById('errorMsgSingup');

    //instanciamos el objetoAjax
    ajax = objetoAjax();

    //Abrimos una conexión AJAX
    ajax.open("POST", "loginCheck.php", true);

    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    ajax.onreadystatechange = function() {

        //Cuando se completa la petición, mostrará los resultados
        if (ajax.readyState === 4){

            //El método responseText() contiene el texto de nuestro 'loginCheck.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
            resultadoForm.innerHTML = (ajax.responseText);
            // Si el acrhivo loginCheck.php responde Success iniciar sesion

            if (resultadoForm.innerText === "success"){
                //vaciamos resultado para que no sea mostrado
                resultadoForm.innerHTML = '';
                //redireccionamos y logueamos al usuario
                //window.location="http://bos.cr/home.php";
                //
                window.location=bookLink;
            }

            //si los datos son erroneos
            if (resultadoForm.innerText === "error"){
                //oculto loader
                $('#singupLoader').hide();
                //mostramos mensaje de error
                resultadoForm.innerHTML = ('¡ You are already registered with this email !');
                //mostramos div del mensaje
                $('#errorMsgLogin').show();
                //mostramos opcion de recuperacion de cuenta
                $('#accountRecovery2').show();
            }

        }
    };

    //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un loginForm.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviamos las variables a 'loginCheck.php'
    ajax.send("&nameReg="+nameReg+"&emailReg="+emailReg+"&passwordReg="+passwordReg+"&signupSubmit="+signupSubmit+"&lastName="+lastName)
}
/* END DATA SENDER LOGIN FORMS */










function getSelectedHotel(hotelID){
    //muestro loader
    $('#getSelectedHotelLoader').show().fadeIn(1000);

    //Recogemos los valores introducimos en los campos de texto

//Aqui seri donde se mostrara el resultado
    reservationsResult = document.getElementById('reservationsResult');

//instanciamos el objetoAjax
    ajax = objetoAjax();

//Abrimos una conexion AJAX
    ajax.open("POST", "../test.php", true);

//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
    ajax.onreadystatechange = function() {

//Cuando se completa la peticion, mostrara los resultados
        if (ajax.readyState === 4){

//El mtodo responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
            reservationsResult.innerHTML = (ajax.responseText);
            //oculto loader
            $('#getSelectedHotelLoader').hide().fadeOut(1000);

        }
    };

//Llamamos al mitodo setRequestHeader indicando que los datos a enviarse eston codificados como un formulario.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

//enviamos las variables a 'consulta.php'
    ajax.send("&hotelID="+hotelID);

}












/*BEING MODAL WINDOW ALERTIFYJS*/
function registrationForm() {

    document.getElementById('singup-form').style.display="none";
    document.getElementById('loginFormDiv').style.display = "block";

    alertify.genericDialog || alertify.dialog('genericDialog', function () {
        return {
            main: function (content) {
                this.setContent(content);
            }, setup: function () {
                return {
                    focus: {
                        element: function () {
                            return this.elements.body.querySelector(this.get('selector'));
                        }, select: true
                    }, options: {basic: true, maximizable: false, resizable: false, padding: false}
                };
            }, settings: {selector: undefined}
        };
    });
    alertify.genericDialog($('#loginFormDiv')[0]);
}
/*END MODAL WINDOW ALERTIFYJS*/









function startEngine() {/*--*/
    var hotelID= $('#hotelID').val();
    var CheckIn= $('#CheckIn').val();
    var CheckOut= $('#CheckOut').val();
    var adults= $('#adults').val();
    var children= $('#children').val();
   // var getBookLinkbtn=$('#bookLink');

    $('.roomElementData').remove();//reset

    //show datepicker
    if(CheckIn ==='' && CheckOut ===''){
        $('.form-control-search-engine').click();
    }

    //check datos
    if(CheckIn!=='' && CheckOut!==''){
        //getBookLinkbtn.attr("href","reservation.php?hotelID="+hotelID+'&start='+CheckIn+'&end='+CheckOut);
        $('#engine').remove();//remover el div engine del dom para que el if vuelva a verificar su existencia

        //al volver a correr el motor de reservas ocultar nuevamente la barra de resultado
        var ResultRoomsNav= $("#ResultRoomsNav");
        ResultRoomsNav.removeClass('show-hidden-footer');
        ResultRoomsNav.addClass('hidden-footer');

//Comprobamos que existe el div dinamico generado por el RoomSearchEngine.php
        var formExists = setInterval(function() {

            if ($("#engine").length) {

                /************** SCRIPT PARA INPUTS TYPE NUMBER *****************/
                (function($) {
                    $.fn.spinner = function() {
                        this.each(function() {
                            var el = $(this);

                            // substract
                            el.parent().on('click', '.sub', function () {
                                if (el.val() > parseInt(el.attr('min'))){
                                    el.val( function(i, oldval) { return --oldval; });
                                    countingDynamic(el.val(),el.attr('data-room'),el.attr('data-name'));
                                }
                            });

                            // increment
                            el.parent().on('click', '.add', function () {
                                if (el.val() < parseInt(el.attr('max'))){
                                    el.val( function(i, oldval) { return ++oldval; });
                                    countingDynamic(el.val(),el.attr('data-room'),el.attr('data-name'));
                                }
                            });
                        });
                    };
                })(jQuery);

                $('.numberInput').spinner();
                /************** SCRIPT PARA INPUTS TYPE NUMBER *****************/


                /*agrega las variables de las habitaciones seleccionadas por URL al btn #bookLink*/
                function countingDynamic(roomVAL,roomID,roomName) {/*-++-*/

                    console.log(roomName);

                    if(roomVAL >= 0){
                       // var getBookLinkbtn=$('#bookLink');
                        //var btnLink=getBookLinkbtn.attr('href');
                        //getBookLinkbtn.attr("href",btnLink+"&roomID"+roomID+'='+roomVAL);



                        /*--------------*-------------*/

                        var divShow=$('#area');
                        var targetElement=$("#roomID"+roomID);
                        if(targetElement.length > 0 ){
                            targetElement.remove();
                        }
                        //create inputs rooms
                        divShow.append('<input type="hidden" class="roomElementData" name=roomID'+roomID+' value='+roomVAL+'   '+'  id=roomID'+roomID+'  />');

                        /*--------------*-------------*/




                    }
                    /*agrega las variables de las habitaciones seleccionadas por URL al btn #bookLink*/

                    //Contamos cuantos items han sido desplegados y de ahi iniciamos el indice del for
                    var ciclo = $('#forIndice').val();
                    var nights = $('#nights').val();
                    var sumaPrecios = 0;
                    var sumaRooms = 0;

                    //iniciamos for partiendo del numero de items que nos devolvio RoomSearchEngine.php
                    for (var i = 1; i < ciclo; i++) {//for

                        var selecCantidad_=$('#selecCantidad_'+i);
                        var rRooms=selecCantidad_.val();
                        var rPrecios=selecCantidad_.attr('data-price')*rRooms;

                        sumaPrecios = sumaPrecios + rPrecios++;
                        sumaRooms = sumaRooms + rRooms++;

                    }//for

                    if (nights > 1){nochesText=nights+' '+$('#nights_text').val();}else{var nochesText=nights+' '+$('#night_text').val();}
                    if (sumaRooms > 1){roomText=sumaRooms+' '+$('#rooms_text').val();}else{var roomText=sumaRooms+' '+$('#room_text').val();}

                    //Mostramos los resultados en el Div con id ResultRoomsNav
                    ResultRoomsNav = document.getElementById('ResultRooms');
                    ResultRoomsNav.innerHTML = (roomText+" "+$('#and_text').val()+nochesText+": $"+Math.round(sumaPrecios*100)/100*nights);

                    //Si no hay ninguna habitacion seleccionada, oculto Div con id ResultRoomsNav
                    var ResultRoomsNav= $("#ResultRoomsNav");
                    if(sumaRooms===0){
                        ResultRoomsNav.removeClass('show-hidden-footer');
                        ResultRoomsNav.addClass('hidden-footer');
                    }else{
                        ResultRoomsNav.removeClass('hidden-footer');
                        ResultRoomsNav.addClass('show-hidden-footer');
                    }

                    /*-++-*/}

                clearInterval(formExists);
            }
        }, 100); // check every 100ms




    }//check datos



    /*--*/}



/* Modals Controls */
function singUp() {
    $('#loginModal').modal('hide');//cerrar ventana de login
    setTimeout("$('#singupModal').modal('toggle')",300);//3 milisegundos despues abrir la de registro
}

function logIn() {
    $('#singupModal').modal('hide');
    setTimeout("$('#loginModal').modal('toggle')",300);
}

/* Modals Controls */




/*Modify users*/
function modifyUsers(userID,sessionID) {
    if (sessionID===userID){
        new PNotify({
            title: 'oh No!',
            text: 'You have an open session, you can not eliminate yourself.<br> Please contact administrator',
            type: 'error',
            styling: 'bootstrap3'
        });
    }else{
        alertify.confirm('Are you sure you want to delete user with ID #'+userID+' ?',
            function(){window.location="http://bos.cr/admin/users.php?deleteUser="+userID;},
            function(){ });
    }
    return true;
}

/*Delete hotels*/
function modifyHotels(hotelID) {

    alertify.confirm('Are you sure you want to delete hotel with ID #'+hotelID+' ?',
        function(){window.location="http://bos.cr/admin/hotels.php?deleteHotel="+hotelID;});

    return true;
}

/*Delete rooms*/
function modifyRooms(roomID) {

    alertify.confirm('Are you sure you want to delete room with ID #'+roomID+' ?',
        function(){window.location="http://bos.cr/admin/rooms.php?deleteRoom="+roomID;});

    return true;
}

/*Delete Add Ons*/
function modifyAddOns(addonsID) {

    alertify.confirm('Are you sure you want to delete add ons with ID #'+addonsID+' ?',
        function(){window.location="http://bos.cr/admin/addons.php?deleteAddOns="+addonsID;});

    return true;
}

/*Carousel*/
$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 3,
                nav: false,
                loop: false,
                margin: 10
            }
        }
    })
});
/*Carousel*/


/*Hide or show payments methods*/
function paymentMethod(method) {

    if(method=='paypal'){
        $('#paypalMethod').show('slow');
        $('#CreditCardMethod').hide('slow');
    }else{
        if(method=='creditCard'){
            $('#paypalMethod').hide('slow');
            $('#CreditCardMethod').show('slow');
        }
    }

}
/*Hide or show payments methods*/


function scrollPolices(){
    $('html,body').animate({scrollTop: $("#down").offset().top}, 500);
}


function paymentModal() {

    /*-- Insert user Data --*/
    $('#userDataLoader').show();

    var firstname= document.getElementById('firstname').value;
    var lastname= document.getElementById('lastname').value;
    var email= document.getElementById('email').value;
    var phone= document.getElementById('phone').value;
    var reserveID= document.getElementById('reserveID').value;

//instanciamos el objetoAjax
    ajax = objetoAjax();

//Abrimos una conexion AJAX
    ajax.open("POST", "libs/models/dataBookerModel.php", true);

//cuando el objeto XMLHttpRequest cambia de estado, la funci�n se inicia
    ajax.onreadystatechange = function() {

//Cuando se completa la peticion, mostrara los resultados
        if (ajax.readyState === 4){

            $('#userDataLoader').hide();
            $('#payment-modal').modal('show');//show modal

        }
    };

//Llamamos al mitodo setRequestHeader indicando que los datos a enviarse eston codificados como un formulario.
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

//enviamos las variables a 'consulta.php'
    ajax.send("&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&phone="+phone+"&reserveID="+reserveID)
    /*-- Insert user Data --*/
}


/*DATERANGEPICKER ROOMS*/
$('input[name="daterangeRooms"]').daterangepicker({
        opens: 'center',
        autoApply: true,
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        minDate: moment(),
        startDate: moment(),
        endDate: moment().subtract(-1, 'days')
    },
    function(start, end) {
        $('input[name="daterangeRooms"]').attr("placeholder", start.format("MMM DD")+" to "+end.format("MMM DD"));
          //  $('#CheckIn').val(start.format('YYYY-MM-DD'));
           // $('#CheckOut').val(end.format('YYYY-MM-DD'));

            //$('#CheckIn_').val(start.format('YYYY-MM-DD'));
            //$('#CheckOut_').val(end.format('YYYY-MM-DD'));
});


/*DATERANGEPICKER*/



if($('#whatLang').val()==='es'){
    $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            autoApply: true,
            autoUpdateInput: false,
            locale: {
                daysOfWeek: [
                    "Lu",
                    "Ma",
                    "Mi",
                    "Ju",
                    "Vi",
                    "Sa",
                    "Do"
                ],
                monthNames: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                format: 'YYYY-MM-DD'
            },
            minDate: moment(),
            startDate: moment(),
            endDate: moment().subtract(-1, 'days')
        },
        function(start, end) {

            if(start.format('YYYY-MM-DD')===end.format('YYYY-MM-DD')){
                datepicker('show');//mostramos daterangepicker

            }else{
                $('#daterange').attr("placeholder", start.format("MMM DD")+" to "+end.format("MMM DD"));
                $('#CheckIn').val(start.format('YYYY-MM-DD'));
                $('#CheckOut').val(end.format('YYYY-MM-DD'));

                $('#CheckIn_').val(start.format('YYYY-MM-DD'));
                $('#CheckOut_').val(end.format('YYYY-MM-DD'));
            }
        });
}else{
    $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            autoApply: true,
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD'
            },
            minDate: moment(),
            startDate: moment(),
            endDate: moment().subtract(-1, 'days')
        },
        function(start, end) {

            if(start.format('YYYY-MM-DD')===end.format('YYYY-MM-DD')){
                datepicker('show');//mostramos daterangepicker

            }else{
                $('#daterange').attr("placeholder", start.format("MMM DD")+" to "+end.format("MMM DD"));
                $('#CheckIn').val(start.format('YYYY-MM-DD'));
                $('#CheckOut').val(end.format('YYYY-MM-DD'));

                $('#CheckIn_').val(start.format('YYYY-MM-DD'));
                $('#CheckOut_').val(end.format('YYYY-MM-DD'));
            }
        });
}








//validar info de usuario (reservation.php)
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function guestValidation() {
    var firstname;
    var lastname;
    var email;
    var phone;
    var polices;

    var valid1;
    var valid2;
    var valid3;
    var valid4;
    var valid5;

    var responseValidation;

    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    email = document.getElementById("email").value;
    phone = document.getElementById("phone").value;
    polices = $('#polices');

    if(firstname.length > 2 ){
        valid1=true;
    }else{
        $('#firstname').addClass('validator-border');
    }

    if(lastname.length > 2){
        valid2=true;
    }else{
        $('#lastname').addClass('validator-border');
    }

    if (validateEmail(email)) {
        valid3=true;
    }else {
        $('#email').addClass('validator-border');
    }

    if(phone.length > 2 && !isNaN(phone)){
        valid4=true;
    }else{
        $('#phone').addClass('validator-border');
    }

    if (polices.is(':checked')) {
        valid5=true;
    }else{
        $('#collapse').addClass('in');
        $('html,body').animate({scrollTop: $("#down").offset().top}, 500);
    }

    if(valid1===true && valid2===true && valid3===true && valid4===true && valid5===true){
        //  responseValidation = true;
        paymentModal();
    }else{
        //alertify.set('notifier','position', 'top-right');
        //alertify.message('We need to know who is reserving, please fill in the fields!');
        //  responseValidation = false;
    }

}
//validar info de usuario (reservation.php)

