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

	

<div class='container '>
	<div class="pt-4">
				<?php
					$con = getConexao();
					if ( isset( $_POST[ 'BotaoEnviar' ] ) ) {
						include '../../dao/_enviarMensagem.php';
					}

					if ( isset( $_POST[ 'cancelar' ] ) ) {
						?>
							<script type='text/javascript'>
								window.location = '../inicio';
							</script>
						<?php
					}
					
					if ( isset( $_POST['eliminarMensagem'] ) ) {
						$idDeletar = $_POST[ 'codSmsEliminar' ];
						$mensagemDao = new MensagemDao();
						$mensagemDao->EliminarMensagem($idDeletar, $nome_usuario, $_POST['textoEliminar']);
					}
				?> 
	</div>
	
    <main class='w-100 d-flex justify-content-center align-items-center'>
        <form method='POST' class=" w-100">
            <center>
			<legend style='font-weight: bold; font-size: 20px;'>Em chat com <?php echo $_SESSION[ 'Nomedestino' ] ?>
			</legend>

			<!--PAGINAR -->
			<?php include '../../dao/_rotasPaginacao.php'; ?>
			
			<div id="buscarSms"></div>
			<script>
				setInterval(() => {
					$('#buscarSms').load('../buscar_sms');
				}, 1000);
			</script>
			
			<br> <br>
			<?php include '../../dao/_rotasPaginacao.php'; ?>

			<input id='btnActualizar' type='hidden' name='exibir' value='Actualizar'> <br>
			
			<div class='col-8 col-lg-5 pt-3 '>
			<textarea class="form-control" placeholder='Escreva aqui a sua Mensagem' name='texto' id='textarea' cols='30' rows='10'
				style='height: 150px; font-size: 20px; background-color: black; color: white;'></textarea>
			</div>

			<div class='col-8 col-lg-5 pt-3 '>
				<input type='hidden' name='id_receptor' value="<?php echo $_SESSION[ 'destinatario' ]; ?>" >
			</div>
			
			<div class='col-8 col-lg-5 pt-3 '>
            	<input class="form-control" id = 'btnEnviar' type = 'submit' name = 'BotaoEnviar' value = 'Enviar'><br>
            </div>
			
			<div class='col-8 col-lg-5  '>
				<input class="form-control" id = 'btnTerminarConversa' type = 'submit' name = 'cancelar' value = 'Terminar conversa'>
			</div>
			</center>
        </form>
    </main>
</div>

<?php
include '../inc/footer.html';
include '../inc/footHTML.html';
?>