<?php



	include 'Conexao.php';
	$con = getConexao();
	$validar = true;

	if (isset($_POST["entrar"])) {

		$nome = mb_convert_case($_POST["nome"], MB_CASE_LOWER);
		$codigo = $_POST["codigo"];
		
		$sql = "select * from usuario where nome = ? and codigo = ?";

		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $codigo);
		$stmt->execute();
		$result = $stmt->fetch();

		if($result["nome"] == $nome && $result["codigo"] == $codigo){

			$_SESSION["id"] = $result["id"];
			$_SESSION["nome"] = $result["nome"];
			$_SESSION["codigo"] = $result["codigo"];

			if(empty($_SESSION["nome"]) || empty($_SESSION["codigo"]) ){
				$validar = false;
				?>
	  <p id="erroUser">
	<?php echo "Introduza correctamente os seus dados, não deve conter campo vazio"; ?>
	 </p>
		
	<?php
			}else{ 
				
			setcookie("utilizador", $_SESSION["id"], time()+3600);
				
		
			?>
			
			<script type="text/javascript">
				
				window.location = "inicio.php";
			</script>
			<?php
			}
		}else{ 
			$validar = false;
			?>
	  <p id="erroUser">
	<?php echo "Usuario Não Encontrado"; ?>
	 </p>
		
	<?php
		}	
	}

	if (isset($_POST["cadastrar"])) {
		?>
			<script type="text/javascript">
				
				window.location = "Cadastro.php";
			</script>
			<?php
	}

?>