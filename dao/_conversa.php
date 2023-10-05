<?php

function TotalConversasUsuario( $usuario ) {
    $con = getConexao();

    $busca = 'select count(codSms) from mensagem where Enviante=? or Recebido=?';
    $stmtbusca = $con->prepare( $busca );
    $stmtbusca->bindValue( 1, $usuario );
    $stmtbusca->bindValue( 2, $usuario );
    $stmtbusca->execute();
    $resultado = $stmtbusca->fetchAll();
    $cont = 0;

    foreach ( $resultado as $valuebusca ) {
        $cont = $valuebusca[ 'count(codSms)' ];
    }

    return $cont;
}

