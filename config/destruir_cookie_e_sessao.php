<?php

if ( isset( $_POST[ 'cancelar' ] ) ) {
    session_destroy();
    setcookie( 'utilizador', '0', time() - 360 );
    ?>
    <script>
    	window.location = '../index';
    </script>
    <?php
}