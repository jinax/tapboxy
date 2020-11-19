<?php

class Caja {
    protected $usuarioID;
    protected $cajaID;
    protected $tipo;
    protected $cajaNombre;
    protected $etiqueta;

    public function getUsuarioID() {
        return $this->usuarioID;
    }

    public function getCajaID() {
        return $this->cajaID;
    }

    public function getCajaNombre() {
        return $this->cajaNombre;
    }

    public function setCajaNombre($cajaNombre){
        $this->cajaNombre = $cajaNombre;
    }
    
    public function getEtiqueta(){
        return $this->etiqueta;
    }

    public function setEtiqueta($etiqueta){
        $this->etiqueta = $etiqueta;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function muestra() {
        print "<p>" . $this->usuarioID . "</p>";
        print "<p>" . $this->cajaID . "</p>";
        print "<p>" . $this->cajaNombre . "</p>";
        print "<p>" . $this->tag . "</p>";
        print "<p>" . $this->tipo . "</p>";
    }

    public function __construct($row) {
        $this->usuarioID = $row['UsuarioID'];
        $this->cajaID = $row['CajaID'];
        $this->cajaNombre = $row['CajaNombre'];
        $this->tag = $row['Etiqueta'];
        $this->tipo = $row['Tipo'];
    }

}