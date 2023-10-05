<?php
 class Mensagem{
    function BuscarMensagem($nome_usuario_logado, $receptor){
        $sqlSms = "select * from mensagem 
        where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
        $stmt = $con->prepare( $sqlSms );
        $stmt->bindValue( 1, $nome_usuario_logado );
        $stmt->bindValue( 2, $receptor );
        $stmt->bindValue( 3, $nome_usuario_logado );
        $stmt->bindValue( 4, $receptor );
        $stmt->execute();
        return $stmt->fetchAll();
    }
 }