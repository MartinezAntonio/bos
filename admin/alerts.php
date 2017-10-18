<!------------------------------------->
<?php function alerts($alertType,$response){ ?>

    <?php if ($alertType=='createUsers' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The user was created successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <?php if ($alertType=='createUsers' and  $response=='error'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'oh No!',
                    text: 'The user you try to create already exist.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
    -------------->

    <?php if ($alertType=='deleteUser' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The user was deleted successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>


    <!-------------
    -------------->

    <?php if ($alertType=='updateUser' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The user was updated successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <?php if ($alertType=='updateUser' and $response=='error'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'oh No!',
                    text: 'Something is wrong.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
    -------------->

    <?php if ($alertType=='createHotels' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The hotel was created successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <?php if ($alertType=='createHotels' and  $response=='error'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'oh No!',
                    text: 'The hotel you try to create already exist.',
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
    -------------->

    <?php if ($alertType=='updateHotel' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The hotel was updated successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
    -------------->

    <?php if ($alertType=='deleteHotel' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The hotel was deleted successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
-------------->

    <?php if ($alertType=='createRooms' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The room was created successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
-------------->

    <?php if ($alertType=='updateRoom' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The room was updated successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
-------------->

    <?php if ($alertType=='deleteRoom' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The room was deleted successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
-------------->

    <?php if ($alertType=='createAddOns' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The Add Ons was created successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

    <!-------------
-------------->

    <?php if ($alertType=='updateAddOns' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The Add Ons was updated successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>

<!-------------
-------------->

    <?php if ($alertType=='deleteAddOns' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'The add ons was deleted successfully.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>


    <?php if ($alertType=='setRates' and $response=='success'){ ?>
        <script>
            window.onload = function() {
                new PNotify({
                    title: 'Yes!',
                    text: 'Rates have been set correctly.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        </script>
    <?php } ?>


    <!-------------
    -------------->


<?php } ?>
<!------------------------------------->


