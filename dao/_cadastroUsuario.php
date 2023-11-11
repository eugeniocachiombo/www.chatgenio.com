<?php
include '__conexao.php';
include 'usuarioDao.php';

Cadastrar();
Logar();
VerficarSeLogado();

function Cadastrar(){
    if ( isset( $_POST[ 'cadastrar' ] ) ) {
        $nome = mb_convert_case( $_POST[ 'nome' ], MB_CASE_LOWER );
        $codigo = $_POST[ 'codigo' ];
        VerificarCampoVazio($nome, $codigo);
    }
}

function VerificarCampoVazio($nome, $codigo){
    if ( empty( $nome ) || empty( $codigo ) ) {
        ?>
            <p class="mt-4" id = 'erroUser'>Introduza correctamente os seus dados, não deve conter campo vazio</p>
        <?php
    } else {
        $resultado = VerificarSeExiste($nome);
        if ( !empty($resultado[ 'nome' ]) && $resultado[ 'nome' ] == $nome ) {
            ?>
                <p class="mt-4" id = 'erroUser'>Já existe um usuário com este nome</p>
            <?php
        } else {
            $usuarioDao = new UsuarioDao();
            $usuario_encontrado = $usuarioDao->CadastrarUsuario($nome,$codigo);
        }
    }
}

function VerificarSeExiste($nome){
    $usuarioDao = new UsuarioDao();
    $resultado = $usuarioDao->BuscarPorNome($nome);
    return $resultado;
}

function Logar(){
    if ( isset( $_POST[ 'logar' ] ) ) {
        ?>
            <script type = 'text/javascript'>
                window.location = '../index/';
            </script>
        <?php
    }
}

function VerficarSeLogado(){
	if ( isset( $_SESSION[ 'id' ] ) ) {
		?>
			<script type = 'text/javascript'>
				window.location = '../inicio/';
			</script>
		<?php
	}
}
?>