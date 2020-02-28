<?php

require_once "modelos/usuario.php";
require_once "modelos/receta.php";
require_once "libs/Database.php";

class Sesion
{
    private $usuario;
    private static $instancia = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function close()
    {
        $_SESSION = [];

        session_destroy();
        return false;
    }

    public static function getInstance()
    {
        session_start();

        if (isset($_SESSION["_sesion"])) :
            self::$instancia = unserialize($_SESSION["_sesion"]);
        else :
            if (self::$instancia === null)
                self::$instancia = new Sesion();
        endif;

        return self::$instancia;
    }

    public function login(string $email, string $pass): bool
    {
        $db = new BaseDeDatos();

        $sql = "SELECT * FROM usuario WHERE Correo='$email' AND Contraseña=MD5('$pass') ;";
        $db->query($sql);

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);


        if ($data != null) :
            $this->usuario = $db->getObject("Usuario");

            $_SESSION["_sesion"] = serialize(self::$instancia);

            return true;

        endif;

        return false;
    }

    public function Usu(string $email, string $pass)
    {
        $db = new BaseDeDatos();

        $sql = "SELECT * FROM usuario WHERE Correo='$email' AND Contraseña=MD5('$pass') ;";
        $db->query($sql);

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);
        return $data;
    }
    
    public function Usu2(string $email, string $pass)
    {
        $db = new BaseDeDatos();

        $sql = "SELECT * FROM usuario WHERE Correo='$email' AND Contraseña='$pass' ;";
        $db->query($sql);
        
        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);
        return $data;
    }


    public function isLogged(): bool
    {
        return !empty($_SESSION);
    }


    public function checkActiveSession(): bool
    {
        if ($this->isLogged())
            return true;
        return false;
    }
}
