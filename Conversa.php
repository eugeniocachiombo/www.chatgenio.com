<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1">
	<title>Conversa</title>

	<script src="js/novoJquery.js"></script>
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mask.js"></script>

	

	<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">


	<link rel="stylesheet" href="estrutura.css">

	<style type="text/css">

		input{
			font-size: 20px;
		}

		#belezaDaSmsEnviante{
			color: white;
			background: rgba(1, 207, 207, 0.788);
			padding: 50px;
			text-align: center;
			width: content;
			border-radius: 50px;
			border: 3px solid white;
		}

		#belezaDaSmsReceptor{
			color: white;
			background: rgba(158, 48, 94, 0.904);
			padding: 50px;
			text-align: center;
			width: content;
			border-radius: 50px;
			border: 3px solid white;
		}

		#btnDel{
			font-weight: bold;
			color: white;
			background: rgba(158, 48, 94, 0.904);
			margin: 5px;
			padding: 5px;
			text-align: center;
			font-size: 15px;
			width: contain;
			height: contain;
			border-color: white;
			border-radius: 50px;
			border: 3px solid white;
		}

		#btnDel:hover{
			color: white;
			background: rgba(158, 48, 94, 0.904);
			margin: 5px;
			padding: 5px;
			cursor: pointer;
			text-align: center;
			width: 150px;
			height: 35px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			border: 3px solid white;
		}

		#smsExcluida{
			color: white;
			background: rgb(211, 23, 23);
			width: content;
		}

		#btnEnviar{
			
			background: rgba(1, 207, 207, 0.788);
			color: white;
			width: 300px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			font-weight: bold;
			border: 3px solid white;
		}

		#btnEnviar:hover{
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 300px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			font-weight: bold;
			border: 3px solid white;
		}

		#btnTerminarConversa{
			background: rgba(1, 207, 207, 0.788);
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			margin: 20px;
			font-weight: bold;
			border: 3px solid white;
		}

		#btnTerminarConversa:hover{
			background-image: url("icones/envio.jpg");
			background:   rgba(158, 48, 94, 0.904);
			cursor: pointer;
			color: white;
			width: 200px;
			border-color: white;
			border-style: double;
			border-radius: 50px;
			font-size: 15px;
			font-weight: bold;
			border: 3px solid white;
		}

		#avançarPágina{
			text-decoration: none;
			background: rgba(1, 207, 207, 0.788);
			font-size: 20px;
			color: white;
			border: 3px solid white;
			border-radius: 20px;
			margin: 5px;
			font-weight: bold;
			padding: 5px;
		}

		#avançarPágina:hover{
			text-decoration: none;
			background:  rgba(158, 48, 94, 0.904);
			font-size: 20px;
			color: white;
			border: 3px solid white;
			border-radius: 20px;
			margin: 5px;
			font-weight: bold;
			padding: 5px;
		}

		#ErroDeEnvio{
			text-align: center;
			color: white;
			background: rgb(211, 23, 23);
			width: content;
		}
	</style>
</head>
<body>
	
		

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

			echo "<img class='UsuarioLogado' src='icones/user1Logado.png'> ".$usuario;?>
			</p>  	
			</div>

			<div>
			<p id="slogan">Génio Pró Chat</p>
			</div>
			
		</header>

		<?php
		if(!isset($_SESSION["nome"])){
			?>
		<script>
			window.location = "index.php";
		</script>
			<?php
		}
	include 'Conexao.php';
	require_once 'Mensagem.php';
	
	$id = $_SESSION["id"];
	$codigo = $_SESSION["id"];
	$usuario = ucwords($_SESSION["nome"]);

	$Logado = new Usuario();
	$Logado->setId($id);
	$Logado->setNome($usuario);
	$Logado->setCodigo($codigo);

	$con = getConexao();	
	
	if (isset($_POST["BotaoEnviar"])) {


		if (!empty($_POST["texto"])) {
			$emissorId = $id;
		$receptorId = $_POST["destinatário"];
		$texto = $_POST["texto"];

		$_SESSION["destino"] = $receptorId;


		$sqlNome = "select * from usuario where id = ? ";
		$stmt = $con->prepare($sqlNome);
		$stmt->bindvalue(1, $receptorId);
		$stmt->execute();
		$result = $stmt->fetch();
		$ReceptorNome = ucwords($result["nome"]);
		$RecptorLogado = new Usuario();
		$RecptorLogado->setNome($ReceptorNome);

		$_SESSION["Nomedestino"] = $RecptorLogado->getNome();

	$sms2 = new Mensagem($Logado, $RecptorLogado, $texto);
	

		$insertSms = "insert into mensagem(texto, Emissor, Receptor, Enviante, Recebido)
		values(?, ?, ?, ?, ?) ";

		$stmt= $con->prepare($insertSms);
		$stmt->bindvalue(1, $texto);
		$stmt->bindvalue(2, $emissorId);
		$stmt->bindvalue(3, $receptorId);
		$stmt->bindvalue(4, $Logado->getNome());
		$stmt->bindvalue(5, $RecptorLogado->getNome());

		if($stmt->execute()){
			$sms2->enviarSms();
			

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
		}else{
			echo "Erro ao enviar na base de dados";
		}
		}else{?>

<p id="ErroDeEnvio"> <?php	echo "Impossível enviar mensagem, campo de texto está vazio";  ?></p>
		
		<?php }
	} 

	if (isset($_POST["cancelar"])) {
	
		//header("location:inicio.php");

?>
		<script type="text/javascript">
				
				window.location = "inicio.php";
			</script>
			<?php
	}
?>
		
		<main>
		
	<form method="POST">

		<fieldset style="text-align: center">

<legend style="font-weight: bold; font-size: 20px;">Em chat com <?php echo $_SESSION["Nomedestino"] ?></legend>

<!--PAGINAR -->
			<?php

			
			
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


			//echo "Total de páginas: " . $_SESSION["pag"];
			
			

			$sqlSms2 = "select * from mensagem  
		where Enviante=? and Recebido=? or Recebido=? and Enviante=?
		";
				$stmt = $con->prepare($sqlSms2);
				$stmt->bindValue(1, $usuario);
				$stmt->bindValue(2, $nomeDest);
				$stmt->bindValue(3, $usuario);
				$stmt->bindValue(4, $nomeDest);
				$stmt->execute();
				$result = $stmt->fetchAll();

				$cont = 0;
				foreach ($result as $value) { $cont++;}

		if($cont > 0){
		?>
		<a id="avançarPágina" href="?pagina=1">Inicio</a>
			<?php

				$antes1 = $pagina1 - 1;
				$prox1 = $pagina1 + 1;
	            
				if($pagina1 > 1){
				?>
		<a id="avançarPágina" href="?pagina=<?=$antes1?>"><<<</a>
					
				<?php
				
				$p->setNum($pagina1);
				$_SESSION["pag"] = $p->getNum();

				} 

				echo "<label id='avançarPágina'>".$pagina1." </label>";

				if($pagina1 < $pagTotal1){?>

		<a id="avançarPágina" href="?pagina=<?=$prox1?>">>>></a>
					
					<?php
					
					$p->setNum($pagina1);
					$_SESSION["pag"] = $p->getNum();
				
					  } ?>
				

		<a id="avançarPágina" href="?pagina=<?=$pagTotal1?>">Final</a>
			<?php } ?>
		<!--PAGINAR -->	

			<div id="buscarSms">
			
			</div>
			<script>

				setInterval(() => {
					$("#buscarSms").load("buscarSms.php");
				}, 1000);
				
			
			</script>	
				
				<?php  if (isset($_POST["BotaoDel_Sms"])) {
               
                    $idDeletar = $_POST["Del"];
            
                    $Ms = "Esta Mensagem foi excluida por: ".$usuario;
                    //$sql = "delete from mensagem where codsms = ?";
            
                    $sql = "update mensagem set texto = ?
                    where codsms = ?";
            
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(1, $Ms);
                    $stmt->bindValue(2, $idDeletar);
                  	$stmt->execute();
                }
                    ?>	
			

				
			 <br> <br>
			<!--PAGINAR -->
		<?PHP	if($cont > 0){
		?>
		<a id="avançarPágina" href="?pagina=1">Inicio</a>
			<?php

				$antes1 = $pagina1 - 1;
				$prox1 = $pagina1 + 1;
	            
				if($pagina1 > 1){
				?>
		<a id="avançarPágina" href="?pagina=<?=$antes1?>"><<<</a>
					
				<?php
				
				$p->setNum($pagina1);
				$_SESSION["pag"] = $p->getNum();

				} 

				echo "<label id='avançarPágina'>".$pagina1."</label>";

				if($pagina1 < $pagTotal1){?>

		<a id="avançarPágina" href="?pagina=<?=$prox1?>">>>></a>
					
					<?php
					
					$p->setNum($pagina1);
					$_SESSION["pag"] = $p->getNum();
				
					  } ?>
				

		<a id="avançarPágina" href="?pagina=<?=$pagTotal1?>">Final</a>
			<?php } ?>
	
			<!--PAGINAR -->
		<input id="btnActualizar" type="hidden" name="exibir" value="Actualizar"> <br>
		<textarea placeholder="Escreva aqui a sua Mensagem" name="texto" id="textarea" cols="30" rows="10" style="width: 300px; height: 150px; font-size: 20px; background-color: black; color: white;" ></textarea>
		

		<?php

		$User1 = "select * from usuario where nome not like ? ";
		$stmt = $con->prepare($User1);
		$stmt->bindvalue(1, $usuario);
		$stmt->execute();
		$result = $stmt->fetchAll(); ?>


		
<input type="hidden" name="destinatário" value="<?php echo $_SESSION["destino"] ?>">

<br>
	

	<input id="btnEnviar" type="submit" name="BotaoEnviar" value="Enviar"><br>

		
		<input id="btnTerminarConversa" type="submit" name="cancelar" value="Terminar conversa">
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
</div>
		
</body>
</html>


