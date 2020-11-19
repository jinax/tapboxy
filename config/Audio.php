<?php

class Audio {
    protected $audioID;
    protected $cajaID;
    protected $direccion;
    protected $audioNombre;

    public function getAudioID() {
        return $this->audioID;
    }
    
    public function getCajaID() {
        return $this->cajaID;
    }

    public function getDireccion() {
        return $this->direccion;
    }
    public function getAudioNombre() {
        return $this->audioNombre;
    }
    public function muestra() {
        print "<p>" . $this->audioID . "</p>";
        print "<p>" . $this->cajaID . "</p>";
        print "<p>" . $this->direccion . "</p>";
        print "<p>" . $this->audioNombre . "</p>";
    }
    public function __construct($row) {
        $this->audioID = $row['AudioID'];
        $this->cajaID = $row['CajaID'];
        $this->direccion = $row['Direccion'];
        $this->audioNombre = $row['AudioNombre'];
    }

}