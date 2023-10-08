<?php
/*
if ( isset( $_COOKIE[ 'utilizador' ] ) && $_COOKIE[ 'utilizador' ] != null ) {
    include '../../dao/__conexao.php';
    $con = GetConexao();
    $sql = 'select * from usuario where id = ?';
    $stmt = $con->prepare( $sql );
    $stmt->bindValue( 1, ( $_COOKIE[ 'utilizador' ] ) );
    $stmt->execute();
    $resultado = $stmt->fetch();

    $_SESSION[ 'id' ] = $resultado[ 'id' ];
    $_SESSION[ 'nome' ] = $resultado[ 'nome' ];
    $_SESSION[ 'codigo' ] = $resultado[ 'codigo' ];
    
    ?>
      <script>
          window.location = '../inicio/';
      </script>
    <?php

}
*/


if(!empty($_SESSION["nome"])){
	?>
		<script>
			window.location = "../inicio";
		</script>
	<?php
}

?>