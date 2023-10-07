<?php
include '../../dao/__conexao.php';
include '../../dao/usuarioDao.php';
include '../../dao/mensagemDao.php';
include '../../class/paginar.php';
include '../../class/mensagem.php';
include '../../class/usuario.php';
include '../../dao/_paginacao.php';
?>

<?php


echo "pagina_actual " . $_SESSION[ 'pag' ];
$mensagemDao = new MensagemDao();
$resultado = $mensagemDao->BuscarMensagemLimitado($nome_usuario, $nome_destino, $pagina_actual, $limite);

$cont = 0;
foreach ( $resultado as $value ) {
	$cont++;
    ?>
	<hr>

	<?php  
			if ( $value[ 'texto' ] == "Mensagem excluida" ) {
    ?>
				<p id='smsExcluida'>
					<?php echo $value[ 'texto' ] . ', enviado por: '. $value[ 'Enviante' ]; ?>
				</p>

	<?php
			} else	if ( ucfirst($value[ 'Enviante' ]) == ucfirst($_SESSION["nome"]) ) {
				?>

				<p id='belezaDoEnviante' 
				style="color: white;
						background: rgba(1, 207, 207, 0.788);
						text-align: center;
						width: fit-content;
						padding: 3px;
						font-weight: bold;
						border-radius: 50px;
						border: 3px solid white; ">
					<?php	echo $value[ 'Enviante' ];
				?>
				</p>

				<div>
					<p id='belezaDaSmsEnviante'> <?php	echo $value[ 'texto' ]; ?> </p>
				</div>

				<?php } else { ?>

				<p id='belezaDoReceptor' 
					style="color: white;
						background: rgba(158, 48, 94, 0.904);
						text-align: center;
						padding: 3px;
						font-weight: bold;
						width: fit-content;
						border-radius: 50px;
						border: 3px solid white;" >

					<?php	echo $value[ 'Enviante' ];
					?>
				</p>

				<div>
					<p id='belezaDaSmsReceptor'> <?php	echo $value[ 'texto' ]; ?> </p>
				</div>

				<?php 
					} ?>

				<form method='post' action=''>
					<?php 
						if ( $value[ 'texto' ] == 'Mensagem excluida') {
									//echo 'Mensagem Excluida com sucesso';
						} else {
							?>
								<input type='hidden' name='codSmsEliminar' value="<?php echo $value['codSms']; ?>">
								<input type='hidden' name='textoEliminar' value="<?php echo 'Mensagem excluida'; ?>">
								<input id='btnDel' type='submit' name='eliminarMensagem' value='Excluir'>
							<?php
						}
					?>
				</form>

				<hr>

			<?php	
}

if ( $cont == 0 ) {
    echo   'Não existe conversa com este usuário';
}
?>