<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	
	<script src="js/novoJquery.js"></script>
	
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mask.js"></script>

	<style>
		body{
			color: white;
			background-color: black;
		}
	</style>

</head>
<body>


	

<?php
    include 'Conexao.php';
	require_once 'Mensagem.php';
	require_once 'Paginar.php';

			$p = new Paginar();


    $con = getConexao();

		
		$pagina = $_SESSION["pag"];

		$limite = 5;

		$inicio = ($pagina * $limite) - $limite;

	


	$id = $_SESSION["id"];
	$codigo = $_SESSION["id"];
	$usuario = ucwords($_SESSION["nome"]);
    $receptorId = $_SESSION["Nomedestino"];

	$Logado = new Usuario();
	$Logado->setId($id);
	$Logado->setNome($usuario);
	$Logado->setCodigo($codigo);

	

        $sqlNome = "select * from usuario where id = ? ";
		$stmt = $con->prepare($sqlNome);
		$stmt->bindvalue(1, $receptorId);
		$stmt->execute();
		$result = $stmt->fetch();

    ?>
       

        <?php

	   // $_SESSION["destino"] = $receptorId;


		$receptorId2 = $_SESSION["destino"];
		$_SESSION["destino"] = $receptorId2;
		$sqlNome2 = "select * from usuario where id = ? ";
		$stmt = $con->prepare($sqlNome2);
		$stmt->bindvalue(1, $receptorId2);
		$stmt->execute();
		$result = $stmt->fetch();
		//$ReceptorNome2 = ucwords($result["nome"]);
        $ReceptorNome2 = ucwords($receptorId);
		$RecptorLogado2 = new Usuario();
		$RecptorLogado2->setNome($ReceptorNome2);

		$_SESSION["Nomedestino"] = $RecptorLogado2->getNome();
		

$sqlSms = "select * from mensagem  
where Enviante=? and Recebido=? or Recebido=? and Enviante=?
limit $inicio, $limite
";
				$stmt = $con->prepare($sqlSms);
				$stmt->bindValue(1, $usuario);
				$stmt->bindValue(2, $RecptorLogado2->getNome());
				$stmt->bindValue(3, $usuario);
				$stmt->bindValue(4, $RecptorLogado2->getNome());
				$stmt->execute();
				$result = $stmt->fetchAll();

				$cont = 0;
				foreach ($result as $value) { $cont++;?>
					<fieldset>
					<hr>

				<?php  if($value["texto"] == "Esta Mensagem foi excluida por: ".$usuario
		|| $value["texto"] == "Esta Mensagem foi excluida por: ".$RecptorLogado2->getNome()
		){ ?>

			

			<p id="smsExcluida">
			<?php echo $value["texto"] .
			" enviado por: ". $value["Enviante"]
			?>
			</p>
			

			<?php
		}else	if($usuario == $value["Enviante"]){ ?>

					<p id="belezaDoEnviante"
		style="color: white;
			background: rgba(1, 207, 207, 0.788);
			text-align: center;
			width: fit-content;
			padding: 3px;
			border-radius: 50px;
			border: 3px solid white;
		">	
						<?php	echo $value["Enviante"]; ?> 
					</p>
					
					<div >
					<p id="belezaDaSmsEnviante"> <?php	echo $value["texto"];  ?> </p>
					</div>


					<?php }else{ ?>
						
					<p id="belezaDoReceptor"
		style="color: white;
			background: rgba(158, 48, 94, 0.904);
			text-align: center;
			padding: 3px;
			width: fit-content;
			border-radius: 50px;
			border: 3px solid white;
		">	
						<?php	echo $value["Enviante"]; ?> 
					</p>
					
					<div >
					<p id="belezaDaSmsReceptor"> <?php	echo $value["texto"];  ?> </p>
					</div>


					<?php } ?>

                    
				<form method="POST" action="Conversa.php">
<input type="hidden"  name="Del" value="<?php	echo $value["codSms"]; ?>">	
	
		<?php if($value["texto"] == "Esta Mensagem foi excluida por: ".$usuario
		|| $value["texto"] == "Esta Mensagem foi excluida por: ".$_SESSION["Nomedestino"]
		){ 

		//echo "Mensagem Excluida com sucesso"; 

		} else{ ?>


	<input id="btnDel" type="submit" name="BotaoDel_Sms" value="Excluir">
	
  
    
    
    <?php }  ?>
				</form>
			
	
				<hr>
					</fieldset>
			

			<?php	} 
            
			


            if ($cont == 0) {
				echo   "Não existe conversa com este usuário";
			
			} ?>
			
		
</body>
</html>


				
         
				
               
     