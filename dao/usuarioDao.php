<?php

class UsuarioDao{

        function BuscarUsuario( $nome, $codigo ){
            $con = getConexao();
            $sql = 'select * from usuario where nome = ? and codigo = md5(?)';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $nome );
            $stmt->bindValue( 2, $codigo );
            $stmt->execute();
            return $stmt->fetch();
        }

        function BuscarTodosExceptoLogado($nome){
            $con = getConexao();
            $sql = 'select * from usuario where nome not like ? ';
            $stmt = $con->prepare( $sql );
            $stmt->bindvalue( 1, $nome );
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function BuscarPorID($id){
            $con = getConexao();
            $sql = 'select * from usuario where id = ?';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $id );
            $stmt->execute();
            return $stmt->fetch();
        }

        function BuscarPorNome($nome){
            $con = GetConexao();
            $sql = 'select nome from usuario where nome = ?';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $nome );
            $stmt->execute();
            return $stmt->fetch();
        }

        function CadastrarUsuario($nome, $codigo){
            $con = GetConexao();
            $sql = "insert into usuario (nome, codigo) values(?, md5(?))";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $nome );
            $stmt->bindValue( 2, $codigo );

            if ( $stmt->execute() ) {
                ?>
                    <p class="mt-4" id = 'sucessoUser'>Cadastrado com sucesso</p>
                <?php
                $_POST["nome"] = "";
                $_POST["codigo"] = "";
            } else {
                ?>
                    <p class="mt-4" id = 'erroUser'>Erro ao cadastrar</p>
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