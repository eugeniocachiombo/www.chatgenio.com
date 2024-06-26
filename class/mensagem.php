<?php

class Mensagem {

    private $codSms;
    private $emissor;
    private $receptor;
    private $texto;

    public function __construct( $emissor, $receptor,  $texto ) {
        $this->emissor = $emissor;
        $this->receptor = $receptor;
        $this->texto = $texto;
    }

    public function getCodSms() {
        return $this->codSms;
    }

    public function setCodSms( $codSms ) {
        $this->codSms = $codSms;
    }

    public function getEmissor() {
        return $this->emissor;
    }

    public function setEmissor( $emissor ) {
        $this->emissor = $emissor;
    }

    public function getReceptor() {
        return $this->receptor;
    }

    public function setReceptor( $receptor ) {
        $this->receptor = $receptor;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto( $texto ) {
        $this->texto = $texto;
    }

    public function enviarSms() {
        /*	echo 'Mensagem Enviada:';
        echo '<br> Emissor: '.$this->getEmissor()->getNome();
        echo '<br> Receptor: '.$this->getReceptor()->getNome();
        echo '<br> Texto: '.$this->getTexto();
        */
    }

    public function receberSms() {
        echo 'Mensagem Recebida:';
        echo '<br> Emissor: '.$this->getEmissor();
        echo '<br> Texto: '.$this->getTexto();
    }
}

?>