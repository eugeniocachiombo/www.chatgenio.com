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

        function CadastrarUsuario($nome,$codigo){
            $con = GetConexao();
            $sql = "insert into usuario (nome, codigo) values(?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $nome );
            $stmt->bindValue( 2, $codigo );

            if ( $stmt->execute() ) {
                ?>
                    <p id = 'sucessoUser'>Cadastrado com sucesso</p>
                <?php
            } else {
                ?>
                    <p id = 'erroUser'>Erro ao cadastrar</p>
                <?php
            }
        }

        function GuardarSessao($id, $nome, $codigo){
            $_SESSION[ 'id' ] = $id;
            $_SESSION[ 'nome' ] = $nome;
            $_SESSION[ 'codigo' ] = $codigo;
        }
}
?>