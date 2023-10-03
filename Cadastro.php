<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1">
	<title>Formulário de Cadastro</title>
	
	<script src="js/jquery.js"></script>
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
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			border: 3px solid white;
		}

		#btnEntrar:hover{
			font-weight: bold;
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			border: 3px solid white;
		}

		#btnLogar{
			font-weight: bold;
			background:  rgba(1, 207, 207, 0.788);
			color: white;
			width: 300px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			margin: 15px;
			border: 3px solid white;
		}

		#btnLogar:hover{
			font-weight: bold;
			background-image: url("icones/envio.jpg");
			background:  rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 300px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			border: 3px solid white;
		}
		
		#att2{
			font-family: Bookman Old Style;
			font-size: 15px;
			font-weight: lighter;
			text-align: center;
			color: white;
		}
		
		#erroUser{
			text-align: center;
			color: white;
			background: rgb(211, 23, 23);
			width: content;
		}

		#cadastroUser{
			margin: 10px;
			text-align: center;
			color: white;
			background: rgb(0, 204, 17);
			width: content;
		}
	</style>

</head>
<body class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
	
		<header>

			<div>
			<img src="icones/logo.png" alt=""></img>
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

	if (isset($_POST["cadastrar"])) {

		$nome = mb_convert_case($_POST["nome"], MB_CASE_LOWER);
		$codigo = $_POST["codigo"];
		
		if(empty($nome) || empty($codigo) ){
			$validar = false;
			?>
  <p id="erroUser">
<?php echo "Introduza correctamente os seus dados, não deve conter campo vazio"; ?>
 </p>

 	
	
<?php
		}else{
			/*************** */

			$sql = "select nome from usuario where nome = ?";

			$stmt = $con->prepare($sql);
			$stmt->bindValue(1, $nome);
			$stmt->execute();
			$result = $stmt->fetch();
	
	
			
			if($result["nome"] == $nome){
				$validar = false;
				?>
  <p id="erroUser">
<?php echo "Já existe um usuário com este nome"; ?>
 </p>
				
 	
	
<?php
			}
			else{
		
				
			
		$sql = "insert into usuario(nome, codigo) 
		values(?, ?)";

		
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $codigo);

		if ($stmt->execute()) {
			
			

			?>
  <p id="cadastroUser">
<?php echo "Cadastrado com sucesso"; ?>
 </p>
	
<?php
		} else{

			echo "Erro ao cadastrar";

		} }	
		/******************* */
	}

	}

	if (isset($_POST["logar"])) {
		?>
			<script type="text/javascript">
				
				window.location = "index.php";
			</script>
			<?php
	}



?>
			<legend><strong style="font-size: 40px">Cadastro</strong></legend>
		<label> <strong>Nome:</strong></label> <br><br>
		<input  id="campoNome" style="border-radius: 10px; width: 200px;border: 3px solid rgba(1, 207, 207, 0.788);" type="text" name="nome" placeholder="Digite um nome"><br><br>

		<label><strong>Código:</strong></label><br><br>
		<input  id="campoCodigo" style="border-radius: 10px; width: 200px;border: 3px solid rgba(1, 207, 207, 0.788);" type="password" name="codigo" placeholder="Digite um código"><br><br>

		<input id="btnEntrar" type="submit" name="cadastrar" value="Cadastrar">

		<br>
	<a href="index.php">
		<input id="btnLogar" type="submit" name="logar" value="Já tem uma conta?">
		</a>
	</fieldset>
	</form>

	<p id="att2"> <label style="color: red; font-size: 15px;">Atenção:</label>  Por questões de segurança é bom anotar o seu Nome e o Código </p>
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
	</div>
</body>
</html>