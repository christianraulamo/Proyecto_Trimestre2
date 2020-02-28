<?php

require_once "BaseController.php";
require_once "libs/Ruta.php";
require_once "modelos/receta.php";
require_once "modelos/ingrediente.php";
require_once "modelos/rec_ingrediente.php";
require_once "libs/sesion.php";

class RecetaController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Listamos las recetas.
     */
    public function listar()
    {
        $email = $_GET["email"];
        $pass  = $_GET["pass"];

        $dat = Receta::findAll();
        $usu = Sesion::Usu2($email, $pass);
        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
    }

    public function ver()
    {

        $email = $_GET["email"];
        $pass  = $_GET["pass"];

        $usu = Sesion::Usu2($email, $pass);
        $dat = Receta::find($_GET["id"]);

        echo $this->twig->render("infoReceta.php.twig", ['dat' => $dat, 'usu' => $usu]);
    }

    public function anadir()
    {
        if (!isset($_GET["nomRec"])) {
            $datG = Ingrediente::findAll();
            $email = $_GET["email"];
            $pass  = $_GET["pass"];

            $dat = Receta::findAll();
            $usu = Sesion::Usu2($email, $pass);
            echo $this->twig->render("addRecetas.php.twig", ['datG' => $datG, 'usu' => $usu]);
        } else if (($_GET["IngredientePrincipal"] === "Otro")) {

            // crear y guardar la receta
            $nomRec = $_GET["nomRec"];
            $Tiempo = $_GET["Tiempo"];
            $Raciones = $_GET["Raciones"];
            $Temporada = $_GET["Temporada"];
            $Posicion = $_GET["Posicion"];
            $Clase = $_GET["Clase"];
            $Tipo = $_GET["Tipo"];
            $Uso = $_GET["Uso"];
            $Metodo = $_GET["Metodo"];
            $IngredientePrincipal = $_GET["IngredientePrincipal"];

            $rec = new Receta();

            // creamos la receta
            $rec->setNomRec($nomRec);
            $rec->setTiempo($Tiempo);
            $rec->setRaciones($Raciones);
            $rec->setTemporada($Temporada);
            $rec->setPosicion($Posicion);
            $rec->setClase($Clase);
            $rec->setTipo($Tipo);
            $rec->setUso($Uso);
            $rec->setMetodo($Metodo);

            // Guardamos la receta
            $rec->save();

            $IdRec = $rec->getIdRec();

            $email = $_GET["email"];
            $pass  = $_GET["pass"];

            $usu = Sesion::Usu2($email, $pass);

            echo $this->twig->render("addIngredientePrincipal.php.twig", ['IdRec' => $IdRec, 'usu' => $usu]);
        } else {

            // crear y guardar la receta
            $nomRec = $_GET["nomRec"];
            $Tiempo = $_GET["Tiempo"];
            $Raciones = $_GET["Raciones"];
            $Temporada = $_GET["Temporada"];
            $Posicion = $_GET["Posicion"];
            $Clase = $_GET["Clase"];
            $Tipo = $_GET["Tipo"];
            $Uso = $_GET["Uso"];
            $Metodo = $_GET["Metodo"];
            $IngredientePrincipal = $_GET["IngredientePrincipal"];

            $rec = new Receta();

            // creamos la receta
            $rec->setNomRec($nomRec);
            $rec->setTiempo($Tiempo);
            $rec->setRaciones($Raciones);
            $rec->setTemporada($Temporada);
            $rec->setPosicion($Posicion);
            $rec->setClase($Clase);
            $rec->setTipo($Tipo);
            $rec->setUso($Uso);
            $rec->setMetodo($Metodo);

            // Guardamos la receta
            $rec->save();

            $IdRec = $rec->getIdRec();

            $per = new Rec_Ingrediente();
            $per->setIdRec($IdRec);
            $per->setIdIngrediente($IngredientePrincipal);

            $per->save();

            $email = $_GET["email"];
            $pass  = $_GET["pass"];

            $usu = Sesion::Usu2($email, $pass);

            // redirigimos al índice
            $email = $_GET["email"];
            $pass  = $_GET["pass"];

            $dat = Receta::findAll();
            $usu = Sesion::Usu2($email, $pass);
            echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
        }
    }

    public function anadirIngrediente()
    {

        // crear y guardar el genero

        $IngredientePrincipal = $_GET["IngredientePrincipal"];
        $IdRec = $_GET["IdRec"];


        $Ing = new Ingrediente();

        // creamos el ingrediente
        $Ing->setIngredientePrincipal($IngredientePrincipal);


        // Guardamos el genero
        $Ing->save();

        $IdIng = $Ing->getIdIngrediente();

        // crear y guardar la tabla Pertenece
        $Rec_Ing = new Rec_Ingrediente();
        $Rec_Ing->setIdRec($IdRec);
        $Rec_Ing->setIdIngrediente($IdIng);

        $Rec_Ing->save();

        

        $email = $_GET["email"];
        $pass  = $_GET["pass"];
        $dat = Receta::findAll();

        $usu = Sesion::Usu2($email, $pass);
        // redirigimos al índice
        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
    }

    /**
     * Borramos la serie.
     */
    public function borrar()
    {
        $ids = $_GET["id"];
        $rec = Receta::find($ids);
        $rec->delete();

        $email = $_GET["email"];
        $pass  = $_GET["pass"];
        $dat = Receta::findAll();

        $usu = Sesion::Usu2($email, $pass);

        /**
         * Redirige al listado de series.
         */
        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat, 'usu' => $usu]);
    }
}
