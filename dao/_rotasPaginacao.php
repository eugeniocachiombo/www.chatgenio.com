<?php

$mensagemDao = new MensagemDao();
$resultado = $mensagemDao->TotalConversasEmissorReceptor( $_SESSION[ 'nome' ], $nome_destino );
$cont = $resultado[ 'count(codsms)' ];

if ( $cont > 0 ) {
    ?>
    <a id = 'avançarPágina' href = '?pagina=1'>Inicio</a>
    <?php
    include '../../dao/_paginacao.php';
    $antes = $pagina_actual - 1;
    $proxima = $pagina_actual + 1;

    if ( $pagina_actual > 1 ) {
        ?>
        <a id = 'avançarPágina' href = "?pagina=<?=$antes?>">
            <<<
        </a>
        <?php
    }

    echo "<label id='avançarPágina'>".$pagina_actual.' </label>';

    if (   $pagina_actual < $total_paginas ) {
        ?>
        <a id = 'avançarPágina' href = "?pagina=<?=$proxima?>">
        >>>
        </a>
        <?php
    }
        
    ?>
        <a id = 'avançarPágina' href = "?pagina=<?=$total_paginas?>">Final</a>
    <?php
    
}