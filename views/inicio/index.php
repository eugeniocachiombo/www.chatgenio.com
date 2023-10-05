<?php
include '../../dao/__conexao.php';
include '../../dao/usuarioDao.php';
include '../../class/mensagem.php';
include '../inc/headHTML.html';
include '../inc/header.php';
?>

<main>

    <?php
        $usuario_logado = $_SESSION["nome"];
        include '../../dao/_conversa.php';
        $totalConversas = TotalConversasUsuario($usuario_logado);
    ?>
    <button>Total de conversas <?php echo $totalConversas?></button>

<form method='POST'>
        <fieldset style='text-align: center'>
            <legend><strong style='font-weight: bold; font-size: 28px;'>Criar uma conversa</strong></legend>

            <?php
                if ( isset( $_POST[ 'exibir' ] ) ) {

                    if ( $_POST[ 'destinatario' ] == 'Selecione um destinatario' ) {

                        ?> <p id='erroUser'> Selecione um destinatário </p> <?php

                    } else {

                        $id_destinatario = $_POST[ 'destinatario' ];
                        $usuarioDao = new UsuarioDao();
                        $resultado = $usuarioDao->BuscarPorID($id_destinatario);

                        $receptor = new Usuario();
                        $receptor->setNome( ucwords( $resultado[ 'nome' ] ) );
                        $_SESSION[ 'Nomedestino' ] = $receptor->getNome();

                        $sqlSms = "select * from mensagem 
                        where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
                        $stmt = $con->prepare( $sqlSms );
                        $stmt->bindValue( 1, $usuario_logado );
                        $stmt->bindValue( 2, $receptor->getNome() );
                        $stmt->bindValue( 3, $usuario_logado );
                        $stmt->bindValue( 4, $receptor->getNome() );
                        $stmt->execute();
                        $result = $stmt->fetchAll();

                        foreach ( $result as $value ) {
                            ?>
                            <hr>
                            <?php	echo $value[ 'Enviante' ]; ?>
                            <br> <br>
                            <?php	echo $value[ 'texto' ]; ?>
                            <hr>
                            <?php	
                        }
                            require_once 'Paginar.php';

                            $p = new Paginar();

                            $pg1 = 1;
                            $pagina1 = 1;

                            if ( isset( $_GET[ 'pagina' ] ) ) {
                                $pg1 = filter_input( INPUT_GET, 'pagina', FILTER_VALIDATE_INT );
                            }

                            if ( !$pg1 ) {
                                $pagina1 = 1;
                            } else {
                                $pagina1 = $pg1;

                            }

                            $limite1 = 5;

                            $nomeDest = $_SESSION[ 'Nomedestino' ];

                            $buscarTotal1 = "select count(codsms) from mensagem
                        where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
                            $stmt1 = $con->prepare( $buscarTotal1 );
                            $stmt1->bindValue( 1, $usuario );
                            $stmt1->bindValue( 2, $nomeDest );
                            $stmt1->bindValue( 3, $usuario );
                            $stmt1->bindValue( 4, $nomeDest );
                            $stmt1->execute();
                            $result1 = $stmt1->fetch();
                            $pagTotal1 = ceil( $result1[ 'count(codsms)' ] / $limite1 );

                            $p->setNum( $pagTotal1 );
                            $_SESSION[ 'pag' ] = $p->getNum();
                            //IR EM ULTIMA CONVERSA

                            ?>
                            <script type='text/javascript'>
                                window.location = "Conversa.php?pagina=<?=$pagTotal1?>";
                            </script>
                            <?php

                        }
                }
                    ?>

            <br> <br>

            <label style='font-weight: bold; font-size: 20px;'>Destinatario:</label> <br>

            <?php
                $usuarioDao = new UsuarioDao();
                $lista_usuarios = $usuarioDao->BuscarTodosExceptoLogado($_SESSION["nome"]);
            ?>

            <select id='Destinatarios' name='destinatario'>
                <option>Selecione um destinatario</option>
                <?php 
                    foreach ( $lista_usuarios as $value ) { ?>
                        <option value="<?php echo $value['id'] ?>">
                            <?php echo ucwords( $value[ 'nome' ] )?>
                        </option>
                <?php
                    } ?>
            </select>
            <br>

            <input id='conversar' type='submit' name='exibir' value='Conversar'> <br>
            <input id='btnTerminarSessão' type='submit' name='cancelar' value='Terminar Sessão'>
        </fieldset>
    </form>
</main>