<?php


$id_destinatario = $_SESSION[ 'destinatario' ];
$usuarioDao = new UsuarioDao();
$resultado = $usuarioDao->BuscarPorID( $id_destinatario );
$_SESSION[ 'Nomedestino' ] = ucwords( $resultado[ 'nome' ] );

$limite = 5;
$pagina_inicio = 1;
$pagina_actual = 1;
$nome_usuario = $_SESSION[ 'nome' ];
$nome_destino = $_SESSION[ 'Nomedestino' ];

if ( isset( $_GET[ 'pagina' ] ) ) {
    $pagina_inicio = filter_input( INPUT_GET, 'pagina', FILTER_VALIDATE_INT );
}

if ( !$pagina_inicio ) {
    $pagina_actual = 1;
} else {
    $pagina_actual = $pagina_inicio;
}

$mensagemDao = new MensagemDao();
$resultado = $mensagemDao->TotalConversasEmissorReceptor( $nome_usuario, $nome_destino );
$total_paginas = ceil( $resultado[ 'count(codsms)' ] / $limite );

$pagina_instancia = new Paginar();
$pagina_instancia->setNum( $total_paginas );


