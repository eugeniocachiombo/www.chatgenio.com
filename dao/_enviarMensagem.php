<?php

$id = $_SESSION[ 'id' ];
$nome_usuario = ucwords( $_SESSION[ 'nome' ] );

$usuario = array( $id, $nome_usuario );

if ( !empty( $_POST[ 'texto' ] ) ) {

    $id_usuario = $id;
    $id_receptor = $_POST[ 'id_receptor' ];
    $texto = $_POST[ 'texto' ];

    $_SESSION[ 'id_destino' ] = $id_receptor;
    $receptor = array( $id_receptor, $_SESSION[ 'Nomedestino' ] );

    $mensagemDao = new MensagemDao();
    $resultado = $mensagemDao->Cadastrar( $usuario, $receptor, $texto );

    if ( $resultado ) {
        ?>
            <script type = 'text/javascript'>
                 window.location = "?pagina=<?=$total_paginas?>";
            </script>
        <?php
    } else {
        echo 'Erro ao enviar na base de dados';
    }
} else {
    ?>
        <p id = 'erroUser'> 
            Impossível enviar mensagem, campo de texto está vazio
        </p>
    <?php 
}