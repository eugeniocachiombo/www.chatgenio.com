<?php

if ( isset( $_POST[ 'cancelar' ] ) ) {
    setcookie( 'utilizador', '44', time() - 360 );
    session_destroy();
    ?>
    <script>
    	window.location = '../index';
    </script>
    <?php
}