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