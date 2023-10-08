<?php session_start(); ?>
<?php
include '../../dao/__conexao.php';
include '../../config/destruir_cookie_e_sessao.php';
include '../../dao/usuarioDao.php';
include '../../dao/mensagemDao.php';
include '../../class/mensagem.php';
include '../../class/paginar.php';
include '../../class/usuario.php';
include '../inc/headHTML.html';
include '../inc/header.php';
include '../../config/verificar_sessao.php';
?>

<div class='container '>
    <main class='w-100 d-flex justify-content-center align-items-center'>
        <form method='POST' class=" w-100">
            <center>
            <div>
                <div class="col-8 col-lg-5 pb-3 d-flex justify-content-center align-items-center">
                    <?php
                        $nome_usuario_logado = $_SESSION[ 'nome' ];
                        $mensagemDao = new MensagemDao();
                        $totalConversas = $mensagemDao->TotalConversasUsuario( $nome_usuario_logado );
                    ?>
                    <button>Total de conversas <?php echo $totalConversas?></button>
                </div>

                <div class='col-8 col-lg-5 pb-3 d-block justify-content-center align-items-center'>
                    <label class='text-start w-100'
                        style='font-size: 26px; font-wight: bold; border-bottom: 2px solid white;'>
                        Criar uma Conversa</label>
                </div>

                <div class=' w-100 col-8 col-lg-5 d-block justify-content-center align-items-center'>
                    <?php
                        if ( isset( $_POST[ 'exibir' ] ) ) {

                            if ( $_POST[ 'destinatario' ] == 'Selecione um destinatario' ) {

                                ?> <p id='erroUser'> Selecione um destinatário </p> <?php

                            } else {
                                $_SESSION[ 'destinatario' ] = $_POST[ 'destinatario' ];
                                include '../../dao/_paginacao.php';
                                ?>
                                    <script>
                                        window.location = "../conversa/index.php?pagina=<?php echo $total_paginas; ?>";
                                    </script>
                                <?php
                            }
                        }
                        ?>
                    
                    <div class="">
                        <label  style='font-weight: bold;'>Destinatario:</label> 
                    </div>


                    <div class='col-8 col-lg-5 pt-3 '>
                        <select class="form-select text-white"  style="background: rgba(1, 207, 207, 0.788);" name='destinatario' >
                            <option>Selecione um destinatario</option>
                            <?php
                                $usuarioDao = new UsuarioDao();
                                $lista_usuarios = $usuarioDao->BuscarTodosExceptoLogado( $_SESSION[ 'nome' ] );
                                foreach ( $lista_usuarios as $value ) {
                                    ?>
                                        <option value="<?php echo $value[ 'id' ]; ?>">
                                            <?php echo ucwords( $value[ 'nome' ] ); ?>
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