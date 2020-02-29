<?php

require_once "BaseController.php";
require_once "libs/Ruta.php";
require_once "modelos/usuario.php";
require_once "modelos/receta.php";
require_once "libs/Sesion.php";

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {

        echo $this->twig->render("login.php.twig");
    }

    public function anadir()
    {
        if (!isset($_GET["NomUsu"])) {
            echo $this->twig->render("registrar.php.twig");
        } else {

            // crear y guardar el usuario
            $Correo = $_GET["Correo"];
            $NomUsu = $_GET["NomUsu"];
            $ApeUsu = $_GET["ApeUsu"];
            $Contraseña = $_GET["Contraseña"];
            $Contraseña2 = $_GET["Contraseña2"];

            $usu = new Usuario();
            if ($Contraseña === $Contraseña2) {

                // creamos el usuario
                $usu->setCorreo($Correo);
                $usu->setNomUsu($NomUsu);
                $usu->setApeUsu($ApeUsu);
                $usu->setContraseña($Contraseña);

                // Guardamos el usuario
                $usu->save();

                // redirigimos al índice
                route('index.php', 'login', 'listar');
            } else {
                echo $this->twig->render("registrar.php.twig", ['Correo' => $Correo, 'NomUsu' => $NomUsu, 'ApeUsu' => $ApeUsu, 'Contraseña' => $Contraseña, 'Contraseña2' => $Contraseña2, 'error' => 1]);
            }
        }
    }

    public function entrar()
    {
        $ses = Sesion::getInstance();

        if (!empty($_GET)) :

            $email = $_GET["email"];
            $pass  = $_GET["pass"];

            $ok  = $ses->login($email, $pass);

            if ($ok) {
                $dat = Receta::findAll();
                $usu = Sesion::Usu($email, $pass);

                echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
            } else {
                echo $this->twig->render("login.php.twig", ["inicio" => 'false']);
            }

        endif;
    }

    public function perfil()
    {
        $ses = Sesion::getInstance();


        $email = $_GET["email"];
        $pass  = $_GET["pass"];

        $usu = Sesion::Usu2($email, $pass);

        echo $this->twig->render("editarPerfil.php.twig", ['usu' => $usu]);
    }

    public function editar()
    {

        $usuario = Usuario::find($_GET["id"]);

        $email = $_GET["email"];
        $pass  = $_GET["pass"];


        $NomUsu = $_GET["NomUsu"];
        $ApeUsu = $_GET["ApeUsu"];

        $usuario->setNomUsu($NomUsu);
        $usuario->setApeUsu($ApeUsu);

        // refrescar el objeto en la base de datos
        $usuario->save();

        $dat = Receta::findAll();
        $usu = Sesion::Usu2($email, $pass);



        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
    }
}
