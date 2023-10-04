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

		if ( $usuario_encontrado[ 'nome' ] == $nome && $usuario_encontrado[ 'codigo' ] == $codigo ) {
			ValidarAutenticacao($usuario_encontrado[ 'nome' ], $usuario_encontrado[ 'codigo' ]);
		} else {
			?>
				<p id = 'erroUser'>Usuario Não Encontrado</p>
			<?php
		}
	
	}
}

function ValidarAutenticacao($nome, $codigo){
	if ( empty( $nome ) || empty( $codigo ) ) {
		?>
			<p id = 'erroUser'> Introduza correctamente os seus dados, não deve conter campo vazio </p>
		<?php
	} else {
		$usuario->GuardarSessao($usuario_encontrado[ 'id' ], $usuario_encontrado[ 'nome' ], $usuario_encontrado[ 'codigo' ]);
		setcookie( 'utilizador', $usuario_encontrado[ 'id' ], time()+3600 );
		?>
			<script>
				window.location = 'inicio.php';
			</script>
		<?php
	}
}

function Cadastrar(){
	if ( isset( $_POST[ 'cadastrar' ] ) ) {
		?>
			<script type = 'text/javascript'>
				window.location = '../views/cadastro/cadastro.php';
			</script>
		<?php
	}
}
 

?>