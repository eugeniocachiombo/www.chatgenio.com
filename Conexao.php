<?php
	
	function getConexao(){

		try {
		$pdo = new PDO("sqlite:conexao.db");

		return $pdo;

		} catch (Exception $e) {
		
		echo "Erro de conexao: ".$e->getMessage();
		}

}
		/*try {

			$host="mysql:host=localhost;dbname=chat;charset=utf8mb4;collate=utf8mb4_general_ci;";
			$user="root";
			$senha= "";

			$pdo = new PDO($host, $user, $senha);
			
			return $pdo;
		} catch (Exception $e) {
			echo "Erro de Conexão: ".$e->getMessage();
		}
		}*/
	





?>