<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1">
	<title>Formulário de Login</title>

	<script src="js/novoJquery.js"></script>
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mask.js"></script>

	<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">

	<link rel="stylesheet" href="estrutura.css">
	<style type="text/css">


		input{
			font-size: 20px;
		}

		#btnEntrar{
			font-weight: bold;
			background: rgba(1, 207, 207, 0.788);
			color: white;
			width: 94px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			border: 3px solid white;
			font-size: 15px;
		}

		#btnEntrar:hover{
			font-weight: bold;
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 94px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			border: 3px solid white;
			font-size: 15px;
		}

		#btnCdastrar{
			font-weight: bold;
			background:  rgba(1, 207, 207, 0.788);
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			border: 3px solid white;
			font-size: 15px;
			margin: 15px;
		}

		#btnCdastrar:hover{
			background-image: url("icones/envio.jpg");
			background:  rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border: 3px solid white;
			border-radius: 50px;
			font-size: 15px;
		}

		#erroUser{
			margin: 5px;
			text-align: center;
			color: white;
			background: rgb(211, 23, 23);
			width: content;
		}
	</style>
</head>
<body class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
	
	
		<header>
			<div>
			<img src="icones/logo.png" alt="">
			</div>

			<div>
			<p id="sessao">  </p>	
			</div>

			<div>
			<p id="slogan">Génio Pró Chat</p>
			</div>
			
		</header>
		
		<main>
	<form method="POST">
		<fieldset style="text-align: center">

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

			<legend><strong style="font-size: 40px">Login</strong></legend>
		<label><strong>Nome:</strong></label> <br>
		<input  id="campoNome" style="border-radius: 10px;padding-right: 35px; width: 250px;border: 3px solid rgba(1, 207, 207, 0.788);" type="text" name="nome" placeholder="Digite o seu nome">
		<img class="campoTextoIcone" src="icones/user1.png" width="28px"><br><br>

		<label><strong>Código:</strong></label><br>
		<input class="senha" id="campoCodigo" style="border-radius: 10px;padding-right: 35px; width: 250px;border: 3px solid rgba(1, 207, 207, 0.788);" type="password" name="codigo" placeholder="Digite o seu código">
		<img onclick="verSenhar()" class="aberto" src="icones/olhoAberto.png" width="28px">
		<img onclick="verSenhar()" class="fechado" src="icones/olhoFechado.png" width="28px">
		<br><br>

		<input id="btnEntrar"  type="submit" name="entrar" value="Logar"> <br>

		
		<input id="btnCdastrar" type="submit" name="cadastrar" value="Cadastrar">
			
	</fieldset>
	</form>
	</main>
		
	<!--Rodapé -->
		<div id="col-md-12 col-sm-12 col-xs-12 col-lg-12"> 

	<footer>
	<div >
        <img id="img" src="icones/logo.png" alt="">
        <p id="slogan">Génio Pró Chat</p>
        </div>

		<p id="att">
        <dl>
            <dt id="textoRodapéTitulo"> <strong>Atenção: </strong> </dt>

            <dd id="textoRodapé">
            Versão de teste, criado por Génio Pró

            Este projecto ainda está a ser desenvolvido, 
            muito em breve estará pronto, aproveite o momento 
            e desfrute das pequenas funcionalidades que deixamos disponíveis para você.
            </dd>
        </dl>
     	</p>


		<div >
        <p id="copyrite">Copyrite .2022 todos os direitos e reservados</p>
    	</div>

        <p id="buscarRodapé"></p>
    </div>

		<script>
			$("#buscarRodapé").load("Rodapé/rodapé.html");
		</script> </footer>
    
		</div>
	<!--Rodapé -->

		<script>

		var nome = "<?php echo $_POST["nome"] ?>";
		var codigo = "<?php echo $_POST["codigo"]?>";
		var validar = "<?php echo $validar?>";
	

		if(validar == false){
			$("#campoNome").val(nome);
		$("#campoCodigo").val(codigo);
		}

		
	</script>
	

	<!--Ver Senha -->
		<script>
		
		var fechado = document.querySelector('.aberto');
		var aberto = document.querySelector('.fechado');
		var senha = document.querySelector('.senha');
		aberto.style = "display: none;"

	function verSenhar(){
			if (senha.type == "password") {

				aberto.style = "display: inline;"
				fechado.style = "display: none;"
				senha.type = "text"
			} else if (senha.type == "text"){

				aberto.style = "display: none;"
				fechado.style = "display: inline;"

				senha.type = "password"
			}
		}
	
	</script>
	<!--Ver Senha -->
</body>
</html>

<?php
		
		
		if(isset($_COOKIE["utilizador"]) && $_COOKIE["utilizador"] != null ){

			

		$sql = "select * from usuario where id = ?";

		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, ($_COOKIE["utilizador"]));
		$stmt->execute();
		$result = $stmt->fetch();

			$_SESSION["id"] = $result["id"];
			$_SESSION["nome"] = $result["nome"];
			$_SESSION["codigo"] = $result["codigo"];
		?>
		<script type="text/javascript">
		window.location = "inicio.php";
		</script>
		<?php
		}

	

?>