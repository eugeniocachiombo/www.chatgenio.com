<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1">

	<title>Inicio</title>

	<script src="js/novoJquery.js"></script>
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mask.js"></script>

	<script src="js/novoJquery.js"></script>
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mask.js"></script>


	<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">

	<link rel="stylesheet" href="estrutura.css">
	<style type="text/css">
	

		textarea{
			color: white;
			background: black;
			font-size: 20px;
		}

		input{
			font-size: 20px;
		}

		#conversar{
			background: rgba(1, 207, 207, 0.788);
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
		}

		#conversar:hover{
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
		}

		#btnTerminarSessão{
			background: rgba(1, 207, 207, 0.788);
			color: white;
			width: 150px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			margin: 20px;
		}

		#btnTerminarSessão:hover{
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 150px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
		}

		#Destinatários{
			background: rgba(1, 207, 207, 0.788);
			color: white;
			margin: 15px;
			font-size: 20px;
		}

		#Destinatários:hover{
			background: rgba(158, 48, 94, 0.904);
			color: white;
			margin: 15px;
			font-size: 20px;
		}

		#ErroDestinatário{
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
			<p id="sessao">
			<?php
			$id = $_SESSION["id"];
			$codigo = $_SESSION["id"];
			$usuario = ucwords($_SESSION["nome"]);

			echo "<label style='color:rgb(0, 0, 0);'>Usuário: </label> ".$usuario;?>
			</p>  	
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
	?>
			<legend style="font-weight: bold; font-size: 20px;">Criar uma conversa</legend>
			
				
				<?php
	if(isset($_POST["exibir"])){

		if($_POST["destinatário"] == "Selecione um destinatário"){

			?> <p id="ErroDestinatário">
		<?php	echo "Selecione um destinatário"; ?>
			</p>
			<?php

		}else{ 

		include_once 'Mensagem.php';
		$receptorId2 = $_POST["destinatário"];
		$_SESSION["destino"] = $receptorId2;
		$sqlNome2 = "select * from usuario where id = ? ";
		$stmt = $con->prepare($sqlNome2);
		$stmt->bindvalue(1, $receptorId2);
		$stmt->execute();
		$result = $stmt->fetch();
		$ReceptorNome2 = ucwords($result["nome"]);
		$RecptorLogado2 = new Usuario();
		$RecptorLogado2->setNome($ReceptorNome2);

		$_SESSION["Nomedestino"] = $RecptorLogado2->getNome();
		

	$sqlSms = "select * from mensagem 
		where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
				$stmt = $con->prepare($sqlSms);
				$stmt->bindValue(1, $usuario);
				$stmt->bindValue(2, $RecptorLogado2->getNome());
				$stmt->bindValue(3, $usuario);
				$stmt->bindValue(4, $RecptorLogado2->getNome());
				$stmt->execute();
				$result = $stmt->fetchAll();

				foreach ($result as $value) {?>
					<fieldset>
					<hr>
				<?php	echo $value["Enviante"]; ?> <br> <br>
				<?php	echo $value["texto"];    ?>
					<hr>
					</fieldset>
			<?php	} //header("Location:Conversa.php");


//IR EM ULTIMA CONVERSA 
			require_once 'Paginar.php';

			$p = new Paginar();
					
			$pg1 = 1;
		$pagina1 = 1;

		if(isset($_GET['pagina'])){
			$pg1 = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
		}
		
		
		if (!$pg1){
		$pagina1 = 1;
		}else{
			$pagina1 = $pg1;	
		}

			$limite1 = 5;

			$nomeDest = $_SESSION["Nomedestino"];

		$buscarTotal1 = "select count(codsms) from mensagem
		where Enviante=? and Recebido=? or Recebido=? and Enviante=?";
		$stmt1 = $con->prepare($buscarTotal1);
		$stmt1->bindValue(1, $usuario);
		$stmt1->bindValue(2, $nomeDest);
		$stmt1->bindValue(3, $usuario);
		$stmt1->bindValue(4, $nomeDest);
		$stmt1->execute();
		$result1 = $stmt1->fetch();
		$pagTotal1 = ceil($result1["count(codsms)"] / $limite1);

		$p->setNum($pagTotal1);
		$_SESSION["pag"] = $p->getNum();
//IR EM ULTIMA CONVERSA

				?>
		<script type="text/javascript">
				
				window.location = "Conversa.php?pagina=<?=$pagTotal1?>";
			</script>
			<?php

			 } }
				?>
				
			 <br> <br>

		

		<label>Destinatário:</label> <br>
	

		<?php

		$User1 = "select * from usuario where nome not like ? ";
		$stmt = $con->prepare($User1);
		$stmt->bindvalue(1, $usuario);
		$stmt->execute();
		$result = $stmt->fetchAll(); ?>


		<select id="Destinatários" name="destinatário">
			 <option>Selecione um destinatário</option>
		<?php	
		foreach ($result as $value) {?>

			<option  value="<?php echo $value["id"] ?>"><?php echo ucwords($value["nome"])?></option>
			<?php	} ?>

		</select>
	<br>
		<input id="conversar" type="submit" name="exibir" value="Conversar"> <br>
		<input id="btnTerminarSessão" type="submit" name="cancelar" value="Terminar Sessão">
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


</body>
</html>
<?php
if (isset($_POST["cancelar"])) {
		session_destroy();


		//header("location:Index.php");
		?>
		<script type="text/javascript">
				
				window.location = "index.php";
			</script>
			<?php
	}