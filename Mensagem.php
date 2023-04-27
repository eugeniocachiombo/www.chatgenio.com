<?php
	
	require_once 'Usuario.php';
	class Mensagem{

		private int $codSms;
		private Usuario $emissor;
		private Usuario $receptor;
		private String $texto;

		public function getCodSms(){
			return $this->codSms;
		}

		public function setCodSms(int $codSms){
			$this->codSms = $codSms;
		}

		public function getEmissor(){
			return $this->emissor;
		}

		public function setEmissor(Usuario $emissor){
			$this->emissor = $emissor;
		}

		public function getReceptor(){
			return $this->receptor;
		}

		public function setReceptor(Usuario $receptor){
			$this->receptor = $receptor;
		}

		public function getTexto(){
			return $this->texto;
		}

		public function setTexto(String $texto){
			$this->texto = $texto;
		}

		public function __construct(
		 Usuario $emissor, Usuario $receptor, String $texto 
		){

		
			$this->emissor = $emissor;
			$this->receptor = $receptor;
			$this->texto = $texto;
		}

		public function enviarSms(){
		/*	echo "Mensagem Enviada:";
			echo "<br> Emissor: ".$this->getEmissor()->getNome();
			echo "<br> Receptor: ".$this->getReceptor()->getNome();
			echo "<br> Texto: ".$this->getTexto();*/
		}
		
		public function receberSms(){
			echo "Mensagem Recebida:";
			echo "<br> Emissor: ".$this->getEmissor();
			echo "<br> Texto: ".$this->getTexto();
		}
	}

?>