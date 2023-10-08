<?php
 class MensagemDao{

    function Cadastrar($usuario, $receptor, $texto){
        $con = getConexao();
        $sql = "insert into mensagem(texto, Emissor, Receptor, Enviante, Recebido)
		values(?, ?, ?, ?, ?) ";
		$stmt= $con->prepare($sql);
		$stmt->bindvalue(1, $texto);
		$stmt->bindvalue(2, $usuario[0]);
		$stmt->bindvalue(3, $receptor[0]);
		$stmt->bindvalue(4, $usuario[1]);
        $stmt->bindvalue(5, $receptor[1]);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function BuscarMensagem($nome_usuario_logado, $receptor){
        $con = getConexao();
        $sql = "select * from mensagem 
        where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $nome_usuario_logado );
        $stmt->bindValue( 2, $receptor );
        $stmt->bindValue( 3, $nome_usuario_logado );
        $stmt->bindValue( 4, $receptor );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function BuscarMensagemLimitado($nome_usuario_logado, $receptor, $inicio_paginar, $limite){
        $con = getConexao();
        $sql = "select * from mensagem  
        where Enviante=? and Recebido=? or Recebido=? and Enviante=?
        limit $inicio_paginar, $limite";
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $nome_usuario_logado );
        $stmt->bindValue( 2, $receptor );
        $stmt->bindValue( 3, $nome_usuario_logado );
        $stmt->bindValue( 4, $receptor );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function TotalConversasEmissorReceptor($nome_usuario, $nome_destino){
        $con = getConexao();
        $sql = "select count(codsms) from mensagem
        where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $nome_usuario );
        $stmt->bindValue( 2, $nome_destino );
        $stmt->bindValue( 3, $nome_usuario );
        $stmt->bindValue( 4, $nome_destino );
        $stmt->execute();
        return $stmt->fetch();
    }

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

    function EliminarMensagem($idDeletar, $nome_usuario, $texto){
        $con = getConexao();
        $sql = "update mensagem set texto = ? where codsms = ?";
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $texto );
        $stmt->bindValue( 2, $idDeletar );
        $stmt->execute();
    }
 }