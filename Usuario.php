<?php

	
	class Usuario{

		private int $id;
		private String $nome;
		private int $codigo;

		public function getNome(){
			return $this->nome;
		}

		public function setNome(String $nome){
			$this->nome = $nome;
		}

		public function getCodigo(){
			return $this->codigo;
		}

		public function setCodigo(int $codigo){
			$this->codigo = $codigo;
		}

		public function getId(){
			return $this->id;
		}

		public function setId(int $id){
			$this->id = $id;
		}

	
	}
?>