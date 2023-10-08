<?php
include '../../dao/__conexao.php';
include '../../dao/usuarioDao.php';
include '../../dao/mensagemDao.php';
include '../../class/paginar.php';
include '../../class/mensagem.php';
include '../../class/usuario.php';
include '../../dao/_paginacao.php';
include '../../config/verificar_cookie.php';
include '../../config/verificar_sessao.php';
?>

<?php
$pagina_actual = isset($_SESSION["pagina_actual"]) ? $_SESSION["pagina_actual"] : 1;
$inicio_paginar = ($pagina_actual * $limite) - $limite;
$mensagemDao = new MensagemDao();
$resultado = $mensagemDao->BuscarMensagemLimitado($nome_usuario, $nome_destino, $inicio_paginar, $limite);

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

					<div class=" w-100 d-flex justify-content-end align-items-center" >
						<p  id='belezaDoEnviante' style=" ">
						( <i class="fas fa-user"></i> )
						</p>
					</div>

					<div>
						<p id='belezaDaSmsEnviante'> <?php	echo $value[ 'texto' ]; ?> </p>
					</div>

				<?php } else { ?>
					<div class=" w-100 d-flex justify-content-start align-items-center" >	
						<p id='belezaDoReceptor' style="" >
						( <?php	echo $value[ 'Enviante' ]; ?> )
						</p>
					</div>

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
								
								<button id='btnDel' type='submit' name='eliminarMensagem'>
									( <i class="fas fa-trash"></i> )
								</button>
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