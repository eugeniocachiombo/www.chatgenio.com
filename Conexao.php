<?php
	
	function getConexao(){

		/*try {
		$pdo = new PDO("sqlite:conexao.db");

		return $pdo;

		} catch (Exception $e) {
		
		echo "Erro de conexao: ".$e->getMessage();
		}

}*/
		try {

			$host="mysql:host=localhost;dbname=id20060316_chat;charset=utf8mb4;collate=utf8_general_ci";
			$user="id20060316_chatroot";
			$senha= "0+KGrWC>/{|?v-zN";

			$pdo = new PDO($host, $user, $senha);
			
			return $pdo;
		} catch (Exception $e) {
			echo "Erro de Conexão: ".$e->getMessage();
		}
		}
	





?>