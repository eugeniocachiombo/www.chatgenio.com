<?php

if ( isset( $_COOKIE[ 'utilizador' ] ) && $_COOKIE[ 'utilizador' ] != null ) {
    $sql = 'select * from usuario where id = ?';
    $stmt = $con->prepare( $sql );
    $stmt->bindValue( 1, ( $_COOKIE[ 'utilizador' ] ) );
    $stmt->execute();
    $resulto = $stmt->fetch();

    $_SESSION[ 'id' ] = $resulto[ 'id' ];
    $_SESSION[ 'nome' ] = $resulto[ 'nome' ];
    $_SESSION[ 'codigo' ] = $resulto[ 'codigo' ];
    ?>
		<script>
			window.location = '../inicio/';
		</script>
    <?php
}

?>