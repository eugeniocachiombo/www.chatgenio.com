<?php

class Usuario {

    private  $id;
    private  $nome;
    private  $codigo;

    public function getNome() {
        return $this->nome;
    }

    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo( $codigo ) {
        $this->codigo = $codigo;
    }

    public function getId() {
        return $this->id;
    }

    public function setId( $id ) {
        $this->id = $id;
    }

}
?>