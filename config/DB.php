<?php
require_once('Usuario.php');
require_once('Caja.php');
require_once('Audio.php');

class DB
{
    protected static function ejecutaConsulta($sql)
    {
        $host = 'localhost';
        $db = 'tapboxydb';
        $usuario = 'root';
        $contrasena = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opc = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $conexion = new PDO($dsn, $usuario, $contrasena, $opc);
        $resultado = null;
        if (isset($conexion)) {
            $resultado = $conexion->query($sql);
        }
        return $resultado;
    }


    // Usuario
    public static function altaUsuario($nick, $pass, $email)
    {
        $passhash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "INSERT INTO Usuarios(Nombre, Contrasena, Email) VALUES ('$nick', '$passhash', '$email'); ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    public static function obtieneDatosUsuario($nick)
    {
        $sql = "SELECT * FROM Usuarios";
        $sql .= " WHERE Nombre='" . $nick . "';";
        $resultado = self::ejecutaConsulta($sql);
        $usuario = null;
        if (isset($resultado)) {
            $row = $resultado->fetch();
            $usuario = new Usuario($row);
        }
        return $usuario;
    }


public static function verificaNombre($nombre, $tabla, $columna){
    $sql = "SELECT * FROM $tabla WHERE $columna='$nombre'; ";
    $resultado = self::ejecutaConsulta($sql);
    $verificado = false;
    if ($resultado->rowCount()>0 && $resultado != null) {
       $verificado = true;
    } 
    return $verificado;
}

    public static function verificaUsuario($nick, $pass)
    {
        $sql = "SELECT * FROM Usuarios ";
        $sql .= "WHERE Nombre='" . $nick . "'; ";
        $resultado = self::ejecutaConsulta($sql);
        $usuario = null;
        $verificado = false;
        if (isset($resultado)) {
            $row = $resultado->fetch();
            $contrasena = $row['Contrasena'];
            if ($contrasena && password_verify($pass, $contrasena)) {
                $verificado = true;
            }
        }
        return $verificado;
    }

    public static function cambiaContrasena($nick, $nuevapass)
    {
        $passhash = password_hash($nuevapass, PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "UPDATE Usuarios
                SET Contrasena = '$passhash'
                WHERE Nombre = '$nick'; ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    public static function borraUsuario($nick){
        $sql = "DELETE FROM Usuarios WHERE Nombre = '$nick'; ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    //Cajas
    public static function obtieneCajas($usuarioID)
    {
        $sql = "SELECT * "
            . "FROM Cajas "
            . "WHERE UsuarioID = '$usuarioID';";
        $resultado = self::ejecutaConsulta($sql);
        $cajas = array();

        if ($resultado) {
            $row = $resultado->fetch();
            while ($row != null) {
                $cajas[] = new Caja($row);
                $row = $resultado->fetch();
            }
        }
        return $cajas;
    }

    public static function creaCaja($usuarioID, $cajaNombre, $etiqueta = null, $tipo)
    {
        $sql = "INSERT INTO Cajas(UsuarioID, CajaNombre, Etiqueta, Tipo) VALUES($usuarioID, '$cajaNombre', '$etiqueta', '$tipo'); ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    public static function borraCaja($cajaNombre)
    {
        $sql = "DELETE FROM Cajas WHERE CajaNombre = '$cajaNombre'; ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    //Audio
    public static function subeAudio($cajaID, $audioNombre, $direccion)
    {
        $sql = "INSERT INTO Audios(CajaID, AudioNombre, Direccion) VALUES($cajaID, '$audioNombre', '$direccion'); ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    public static function obtieneAudios($cajaID)
    {
        $sql = "SELECT * "
            . "FROM Audios "
            . "WHERE CajaID = '$cajaID';";
        $resultado = self::ejecutaConsulta($sql);
        $audios = array();
        if ($resultado) {
            $row = $resultado->fetch();
            while ($row != null) {
                $audios[] = new Audio($row);
                $row = $resultado->fetch();
            }
        }
        return $audios;
    }

    public static function borraAudio($audioNombre)
    {
        $sql = "DELETE FROM Audios WHERE AudioNombre = '$audioNombre'; ";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;
        if (isset($resultado)) {
            $verificado = true;
        }
        return $verificado;
    }

    public static function obtieneAudioBorrar($audioNombre){
        $sql = "SELECT * FROM Audios WHERE AudioNombre = '$audioNombre'; ";
        $resultado = self::ejecutaConsulta($sql);
        $audio = null;
        if (isset($resultado)) {
            $row = $resultado->fetch();
            $audio = new Audio($row);
        }
        return $audio;
    }

    public static function obtieneBusquedaCajas($palabras){
        $palabrasGuion = str_replace(" ", "_", $palabras);
        $sql = "SELECT DISTINCT * FROM Cajas WHERE Tipo='Publica' AND CajaID IN (SELECT CajaID from Audios) AND (CajaNombre LIKE '%$palabrasGuion%' OR Etiqueta LIKE '%$palabrasGuion%') OR Cajas.CajaID IN (SELECT CajaID FROM Audios WHERE AudioNombre LIKE '%$palabrasGuion%') AND Tipo='Publica' AND CajaID IN (SELECT CajaID from Audios);";
        $resultado = self::ejecutaConsulta($sql);
        $cajas = array();
        if ($resultado) {
            $row = $resultado->fetch();
            while ($row != null) {
                $cajas[] = new Caja($row);
                $row = $resultado->fetch();
            }
        }
        return $cajas;
    }
}
