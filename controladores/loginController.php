<?php

require_once "baseController.php";
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
            $Contraseña = md5($_GET["Contraseña"]);

            $usu = new Usuario();

            // creamos la receta
            $usu->setCorreo($Correo);
            $usu->setNomUsu($NomUsu);
            $usu->setContraseña($Contraseña);

            // Guardamos el usuario
            $usu->save();

            // redirigimos al índice
            route('index.php', 'login', 'listar');
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
        
        print_r($usu);


        echo $this->twig->render("editarPerfil.php.twig", ['usu' => $usu]);
    }

    public function editar()
    {
        $ses = Sesion::getInstance();


        $email = $_GET["email"];
        $pass  = $_GET["pass"];

        $usu = Sesion::Usu2($email, $pass);
        
        print_r($usu);


        echo $this->twig->render("editarPerfil.php.twig", ['usu' => $usu]);
    }
}
