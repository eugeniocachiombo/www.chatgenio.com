<?php
include '__conexao.php';
include 'usuarioDao.php';

Logar();
Cadastrar();

function Logar(){
	if ( isset( $_POST[ 'entrar' ] ) ) {
		$con = getConexao();
		$nome = mb_convert_case( $_POST[ 'nome' ], MB_CASE_LOWER );
		$codigo = $_POST[ 'codigo' ];
		$usuarioDao = new UsuarioDao();
		$usuario_encontrado = $usuarioDao->BuscarUsuario($nome,$codigo);
		VerificarSeExiste($nome, $codigo, $usuario_encontrado);
	}
}

function VerificarSeExiste($nome, $codigo, $usuario_encontrado){
	if ( !empty($resultado_encontrado[ 'nome' ]) && $usuario_encontrado[ 'nome' ] == $nome && !empty($usuario_encontrado[ 'codigo' ]) && $usuario_encontrado[ 'codigo' ] == $codigo ) {
		ValidarAutenticacao($usuario_encontrado[ 'id' ], $usuario_encontrado[ 'nome' ], $usuario_encontrado[ 'codigo' ]);
	} else {
		?>
			<p class="mt-4" id = 'erroUser'>Usuario Não Encontrado</p>
		<?php
	}
}

function ValidarAutenticacao($id, $nome, $codigo){
	if ( empty( $nome ) || empty( $codigo ) ) {
		?>
			<p class="mt-4" id = 'erroUser'> Introduza correctamente os seus dados, não deve conter campo vazio </p>
		<?php
	} else {
		$usuarioDao = new UsuarioDao();
		$usuarioDao->GuardarSessao($id, $nome, $codigo);
		setcookie( 'utilizador', $id, time()+3600 );
		?>
			<script>
				window.location = '../inicio/';
			</script>
		<?php
	}
}

function Cadastrar(){
	if ( isset( $_POST[ 'cadastrar' ] ) ) {
		?>
			<script type = 'text/javascript'>
				window.location = '../cadastro/';
			</script>
		<?php
	}
}
 

?>