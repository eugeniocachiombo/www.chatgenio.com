<?php

class UsuarioDao{

        function BuscarUsuario($nome,$codigo){
            $con = getConexao();
            $sql = 'select * from usuario where nome = ? and codigo = ?';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $nome );
            $stmt->bindValue( 2, $codigo );
            $stmt->execute();
            return $stmt->fetch();
        }

        function GuardarSessao($id, $nome, $codigo){
            $_SESSION[ 'id' ] = $id;
            $_SESSION[ 'nome' ] = $nome;
            $_SESSION[ 'codigo' ] = $codigo;
        }
}
?>