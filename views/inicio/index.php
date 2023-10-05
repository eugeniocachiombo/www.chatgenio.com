<?php
include '../../dao/__conexao.php';
include '../../dao/usuarioDao.php';
include '../../class/mensagem.php';
include '../inc/headHTML.html';
include '../inc/header.php';
?>

<div class='container '>
    <main class='w-100 d-flex justify-content-center align-items-center'>
        <form method='POST' class=" w-100">
            <center>
            <div>
                <div class="col-8 col-lg-5 pb-3 d-flex justify-content-center align-items-center">
                    <?php
                        $nome_usuario_logado = $_SESSION[ 'nome' ];
                        include '../../dao/_conversa.php';
                        $totalConversas = TotalConversasUsuario( $nome_usuario_logado );
                    ?>
                    <button>Total de conversas <?php echo $totalConversas?></button>
                </div>

                <div class='col-8 col-lg-5 pb-3 d-block justify-content-center align-items-center'>
                    <label class='text-start w-100'
                        style='font-size: 30px; font-wight: bold; border-bottom: 2px solid white;'>Criar uma
                        Conversa</label>
                </div>

                <div class=' w-100 col-8 col-lg-5 d-block justify-content-center align-items-center'>
                    <?php
                        if ( isset( $_POST[ 'exibir' ] ) ) {

                            if ( $_POST[ 'destinatario' ] == 'Selecione um destinatario' ) {

                                ?> <p id='erroUser'> Selecione um destinatário </p> <?php

                            } else {

                                $id_destinatario = $_POST[ 'destinatario' ];
                                $usuarioDao = new UsuarioDao();
                                $resultado = $usuarioDao->BuscarPorID( $id_destinatario );

                                $receptor = new Usuario();
                                $receptor->setNome( ucwords( $resultado[ 'nome' ] ) );
                                $_SESSION[ 'Nomedestino' ] = $receptor->getNome();

                                $mensagens = new Mensagem();
                                $resultado = $mensagens->BuscarMensagem( $nome_usuario_logado, $receptor->getNome() );

                                foreach ( $resultado as $value ) {
                                    ?>
                                        <hr>
                                        <?php	echo $value[ 'Enviante' ];
                                    ?>
                                        <br> <br>
                                        <?php	echo $value[ 'texto' ];
                                    ?>
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

                                ?>
                                    <script type='text/javascript'>
                                        window.location = "Conversa.php?pagina=<?=$pagTotal1?>";
                                    </script>
                                <?php

                            }
                        }
                        ?>
                    
                    <div class="">
                        <label  style='font-weight: bold;'>Destinatario:</label> 
                    </div>

                    <?php
                        $usuarioDao = new UsuarioDao();
                        $lista_usuarios = $usuarioDao->BuscarTodosExceptoLogado( $_SESSION[ 'nome' ] );
                    ?>

                    <div class='col-8 col-lg-5 pt-3 '>
                        <select class="form-select text-white"  style="background: rgba(1, 207, 207, 0.788);" name='destinatario' >
                            <option>Selecione um destinatario</option>
                            <?php
                            foreach ( $lista_usuarios as $value ) {
                                ?>
                            <?php echo ucwords( $value[ 'nome' ] )?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class='col-8 col-lg-5 pt-3 '>
                    <input class="form-control" id='conversar' type='submit' name='exibir' value='Conversar'>
                </div>

                <div class='col-8 col-lg-5 pt-3'>
                    <input class="form-control" id='btnTerminarSessão' type='submit' name='cancelar' value='Terminar Sessão'>
                </div>
            </div>
            </center>
        </form>
    </main>
</div>

<?php
include '../inc/footer.html';
include '../inc/footHTML.html';
?>