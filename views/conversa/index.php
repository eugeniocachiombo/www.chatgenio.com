<?php
include '../../dao/__conexao.php';
include '../../dao/usuarioDao.php';
include '../../dao/mensagemDao.php';
include '../../class/paginar.php';
include '../../class/mensagem.php';
include '../../class/usuario.php';
include '../inc/headHTML.html';
include '../inc/header.php';
include '../../dao/_paginacao.php';
?>

<?php

$con = getConexao();

if ( isset( $_POST[ 'BotaoEnviar' ] ) ) {

    $id = $_SESSION[ 'id' ];
    $nome_usuario = ucwords( $_SESSION[ 'nome' ] );

	$usuario = array($id, $nome_usuario);

    if ( !empty( $_POST[ 'texto' ] ) ) {

        $id_usuario = $id;
        $id_receptor = $_POST[ 'id_receptor' ];
        $texto = $_POST[ 'texto' ];

        $_SESSION[ 'id_destino' ] = $id_receptor;
        $receptor = new Usuario();
		$receptor->setNome( $_SESSION[ 'Nomedestino' ] );
		

        $mensagemDao = new MensagemDao();
        $resultado = $mensagemDao->Cadastrar( $usuario, $receptor, $texto );

        if ( $resultado ) {

            ?>
				<script type='text/javascript'>
					window.location = "?pagina=<?=$total_paginas?>";
				</script>

			<?php
        } else {
            echo 'Erro ao enviar na base de dados';
        }
    } else {
        ?>

<p id='ErroDeEnvio'> <?php	echo 'Impossível enviar mensagem, campo de texto está vazio';
        ?></p>

<?php }
    }

    if ( isset( $_POST[ 'cancelar' ] ) ) {
        ?>
			<script type='text/javascript'>
				window.location = '../inicio';
			</script>
		<?php
    }
    ?>

<main>
	<form method='POST'>
		<fieldset style='text-align: center'>
			<legend style='font-weight: bold; font-size: 20px;'>Em chat com <?php echo $_SESSION[ 'Nomedestino' ] ?>
			</legend>

			<!--PAGINAR -->
			<?php

			$nome_destino = $_SESSION[ 'Nomedestino' ];
			$sqlnova_mensagem = "select * from mensagem  
				where Enviante=? and Recebido=? or Recebido=? and Enviante=?
				";
			$stmt = $con->prepare( $sqlnova_mensagem );
			$stmt->bindValue( 1, $_SESSION[ 'nome' ] );
			$stmt->bindValue( 2, $nome_destino );
			$stmt->bindValue( 3, $_SESSION[ 'nome' ] );
			$stmt->bindValue( 4, $nome_destino );
			$stmt->execute();
			$result = $stmt->fetchAll();

			$cont = 0;
			foreach ( $result as $value ) {
				$cont++;
			}

			if ( $cont > 0 ) {
				?>
					<a id='avançarPágina' href='?pagina=1'>Inicio</a>
					<?php
				include '../../dao/_paginacao.php';
				$antes1 = $pagina_actual - 1;
				$total_paginas = $pagina_actual + 1;

				if ( $pagina_actual > 1 ) {
					?>
					<a id='avançarPágina' href="?pagina=<?=$antes1?>">
						<<<</a> <?php

					$pagina_instancia->setNum( $pagina_actual );
					$_SESSION[ 'pag' ] = $pagina_instancia->getNum();

				}	

        echo "<label id='avançarPágina'>".$pagina_actual.' </label>';

        if ( $pagina_actual < $total_paginas ) {
            ?> <a id='avançarPágina' href="?pagina=<?=$total_paginas?>">>>>
			</a>

			<?php

            $pagina_instancia->setNum( $pagina_actual );
            $_SESSION[ 'pag' ] = $pagina_instancia->getNum();

        }
        ?>

			<a id='avançarPágina' href="?pagina=<?=$total_paginas?>">Final</a>
			<?php }
        ?>
			<!--PAGINAR -->

			<div id='buscarSms'>

			</div>
			<script>
				setInterval(() => {
					$('#buscarSms').load('../buscar_sms');
				}, 1000);
			</script>

			<?php  if ( isset( $_POST[ 'BotaoDel_Sms' ] ) ) {

            $idDeletar = $_POST[ 'Del' ];

            $Ms = 'Esta Mensagem foi excluida por: '.$usuario;
            //$sql = 'delete from mensagem where codsms = ?';

            $sql = "update mensagem set texto = ?
                    where codsms = ?";

            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $Ms );
            $stmt->bindValue( 2, $idDeletar );
            $stmt->execute();
        }
        ?>

			<br> <br>
			<!--PAGINAR -->
			<?PHP	if ( $cont > 0 ) {
            ?>
			<a id='avançarPágina' href='?pagina=1'>Inicio</a>
			<?php

            $antes1 = $pagina_actual - 1;
            $total_paginas = $pagina_actual + 1;

            if ( $pagina_actual > 1 ) {
                ?>
			<a id='avançarPágina' href="?pagina=<?=$antes1?>">
				<<<</a> <?php

                $pagina_instancia->setNum( $pagina_actual );
                $_SESSION[ 'pag' ] = $pagina_instancia->getNum();

            }

            echo "<label id='avançarPágina'>".$pagina_actual.'</label>';

            if ( $pagina_actual < $total_paginas ) {
                ?> <a id='avançarPágina' href="?pagina=<?=$total_paginas?>">>>>
			</a>

			<?php

                $pagina_instancia->setNum( $pagina_actual );
                $_SESSION[ 'pag' ] = $pagina_instancia->getNum();

            }
            ?>

			<a id='avançarPágina' href="?pagina=<?=$total_paginas?>">Final</a>
			<?php }
            ?>

			<!--PAGINAR -->
			<input id='btnActualizar' type='hidden' name='exibir' value='Actualizar'> <br>
			<textarea placeholder='Escreva aqui a sua Mensagem' name='texto' id='textarea' cols='30' rows='10'
				style='width: 300px; height: 150px; font-size: 20px; background-color: black; color: white;'></textarea>

			<?php

            $User1 = 'select * from usuario where nome not like ? ';
            $stmt = $con->prepare( $User1 );
            $stmt->bindvalue( 1, $_SESSION[ 'nome' ] );
            $stmt->execute();
            $result = $stmt->fetchAll();
            ?>

			<input type='hidden' name='id_receptor' value="<?php echo $_SESSION['id_destino'] ?>" >

            <br>

            <input id = 'btnEnviar' type = 'submit' name = 'BotaoEnviar' value = 'Enviar'><br>

            <input id = 'btnTerminarConversa' type = 'submit' name = 'cancelar' value = 'Terminar conversa'>
            </fieldset>

            </form>
            </main>

            <?php
            include '../inc/footer.html';
            include '../inc/footHTML.html';
            ?>