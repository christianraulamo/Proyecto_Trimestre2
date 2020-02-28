<?php

require_once "BaseController.php";
require_once "libs/Ruta.php";
require_once "modelos/receta.php";
require_once "modelos/ingrediente.php";
require_once "modelos/rec_ingrediente.php";

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
        $dat = Receta::findAll();
        echo $this->twig->render("verRecetas.php.twig", ['dat' => $dat]);
    }

    public function ver()
    {
        $dat = Receta::find($_GET["id"]);

        echo $this->twig->render("infoReceta.php.twig", ['dat' => $dat]);
    }

    public function anadir()
    {
        if (!isset($_GET["nomRec"])) {
            $datG = Ingrediente::findAll();
            echo $this->twig->render("addRecetas.php.twig", ['datG' => $datG]);
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

            echo $this->twig->render("addIngredientePrincipal.php.twig", ['IdRec' => $IdRec]);
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

            // redirigimos al índice
            route('index.php', 'receta', 'listar');
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

        // redirigimos al índice
       route('index.php', 'receta', 'listar');
    }

    /**
     * Borramos la serie.
     */
    public function borrar()
    {
        $ids = $_GET["id"];
        $rec = Receta::find($ids);
        $rec->delete();

        /**
         * Redirige al listado de series.
         */
        route('index.php', 'receta', 'listar');
    }
}
