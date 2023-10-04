<?php

function getConexao() {

    try {

        /*
        $host = 'mysql:host=localhost;dbname=id20060316_chat;charset=utf8mb4;collate=utf8_general_ci';
        $user = 'id20060316_chatroot';
        $senha = '0+KGrWC>/{|?v-zN';
        $pdo = new PDO( $host, $user, $senha );
        */
        $host = 'mysql:host=localhost;dbname=chat;charset=utf8mb4;collate=utf8_general_ci';
        $user = 'root';
        $senha = '';
        $pdo = new PDO( $host, $user, $senha );

        //$pdo = new PDO( 'sqlite:conexao.db' );
        return $pdo;

    } catch ( Exception $e ) {
        echo 'Erro de conexao: '.$e->getMessage();
    }

}

?>