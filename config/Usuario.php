<?php

class Usuario {
    protected $usuarioID;
    protected $nombre;
    protected $email;
    protected $contrasena;
    protected $rol;
   

    public function getUsuarioID() {
        return $this->usuarioID;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasena(){
        return $this->contrasena;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRol() {
        return $this->rol;
    }

    public function muestra() {
        print "<p>" . $this->usuarioID . "</p>";
        print "<p>" . $this->nombre . "</p>";
        print "<p>" . $this->email . "</p>";
        print "<p>" . $this->contrasena . "</p>";
        print "<p>" . $this->rol . "</p>";
    }

    public function __construct($row) {
        $this->usuarioID = $row['UsuarioID'];
        $this->nombre = $row['Nombre'];
        $this->email = $row['Email'];
        $this->contrasena = $row['Contrasena'];
        $this->rol = $row['Rol'];
    }

}