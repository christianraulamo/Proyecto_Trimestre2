<?php

require_once "libs/Database.php";

class Receta
{
    private $IdRec;
    private $NomRec;
    private $Tiempo;
    private $Raciones;
    private $Temporada;
    private $IngredientePrincipal;
    private $Posicion;
    private $Clase;
    private $Tipo;
    private $Uso;
    private $Metodo;
    private $NomFichero;
    private $IdIngredientePrincipal;

    public function __construct()
    {
    }

    /**
     * @return mixed $IdRec
     */
    public function getIdRec()
    {
        return $this->IdRec;
    }

    /**
     * @return mixed $IdRec
     */
    public function setIdRec($IdRec)
    {
        $this->IdRec = $IdRec;

        return $this;
    }

    /**
     * @return mixed $NomRec
     */
    public function getNomRec()
    {
        return $this->NomRec;
    }

    /**
     * @return mixed $NomRec
     */
    public function setNomRec($NomRec)
    {
        $this->NomRec = $NomRec;

        return $this;
    }

    /**
     * @return mixed $Tiempo
     */
    public function getTiempo()
    {
        return $this->Tiempo;
    }

    /**
     * @return mixed $Tiempo
     */
    public function setTiempo($Tiempo)
    {
        $this->Tiempo = $Tiempo;

        return $this;
    }

    /**
     * @return mixed $Raciones
     */
    public function getRaciones()
    {
        return $this->Raciones;
    }

    /**
     * @return mixed $Raciones
     */
    public function setRaciones($Raciones)
    {
        $this->Raciones = $Raciones;

        return $this;
    }

    /**
     * @return mixed $Temporada
     */
    public function getTemporada()
    {
        return $this->Temporada;
    }

    /**
     * @return mixed $Temporada
     */
    public function setTemporada($Temporada)
    {
        $this->Temporada = $Temporada;

        return $this;
    }

    /**
     * @return mixed $IngredientePrincipal
     */
    public function getIngredientePrincipal()
    {
        return $this->IngredientePrincipal;
    }

    /**
     * @return mixed $IngredientePrincipal
     */
    public function setIngredientePrincipal($IngredientePrincipal)
    {
        $this->IngredientePrincipal = $IngredientePrincipal;

        return $this;
    }

    /**
     * @return mixed $Posicion
     */
    public function getPosicion()
    {
        return $this->Posicion;
    }

    /**
     * @return mixed $Posicion
     */
    public function setPosicion($Posicion)
    {
        $this->Posicion = $Posicion;

        return $this;
    }

    /**
     * @return mixed $Clase
     */
    public function getClase()
    {
        return $this->Clase;
    }

    /**
     * @return mixed $Clase
     */
    public function setClase($Clase)
    {
        $this->Clase = $Clase;

        return $this;
    }

    /**
     * @return mixed $Tipo
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @return mixed $Tipo
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * @return mixed $Uso
     */
    public function getUso()
    {
        return $this->Uso;
    }

    /**
     * @return mixed $Uso
     */
    public function setUso($Uso)
    {
        $this->Uso = $Uso;

        return $this;
    }

    /**
     * @return mixed $Metodo
     */
    public function getMetodo()
    {
        return $this->Metodo;
    }

    /**
     * @return mixed $Metodo
     */
    public function setMetodo($Metodo)
    {
        $this->Metodo = $Metodo;

        return $this;
    }

    /**
     * @return mixed $getIdIngredientePrincipal
     */
    public function getIdIngredientePrincipal()
    {
        return $this->IdIngredientePrincipal;
    }

    /**
     * @return mixed $getIdIngredientePrincipal
     */
    public function setIdIngredientePrincipal($IdIngredientePrincipal)
    {
        $this->IdIngredientePrincipal = $IdIngredientePrincipal;

        return $this;
    }



    /**
     * Consulta a la tabla serie de la base de datos
     * y devuelve todas las series.
     */
    public static function findAll()
    {
        $db = new BaseDeDatos();
        $db->query("SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
                     Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
                     on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec");

        $data = [];
        while ($obj = $db->getObject("Receta"))
            array_push($data, $obj);

        return $data;
    }

    /**
     * Consulta a la tabla serie de la base de datos
     * y devuelve una serie en concreto.
     */
    public static function find(int $id): Receta
    {
        $db = new BaseDeDatos();
        $db->query("SELECT receta.IdRec, NomRec, Tiempo, Raciones, Temporada, IngredientePrincipal,
        Posicion, Clase, Tipo, Uso, Metodo FROM ingrediente INNER join rec_ingrediente 
        on ingrediente.IdIngrediente = rec_ingrediente.idIngrediente INNER JOIN receta ON rec_ingrediente.IdRec = receta.IdRec WHERE receta.IdRec = $id ;");

        return $db->getObject("Receta");
    }

    /**
     * Guarda en la base de datos un nueva receta.
     */
    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->IdRec)) :

            $sql = "INSERT INTO receta (NomRec, Tiempo, Raciones, Temporada, Posicion, Clase, Tipo, Uso, Metodo) 
                                VALUES ('{$this->NomRec}', '{$this->Tiempo}', '{$this->Raciones}',
                                '{$this->Temporada}', '{$this->Posicion}', '{$this->Clase}', 
                                '{$this->Tipo}', '{$this->Uso}', '{$this->Metodo}') ;";

        
            $db->query($sql);

            $this->IdRec = $db->lastId();

        endif;

        return $this;
    }

    /**
     * Borra en la base de datos una receta en concreto.
     */
    public function delete()
    {
        $db = new BaseDeDatos();
        $db->query("DELETE FROM receta WHERE IdRec={$this->IdRec} ;");
        $db->query("DELETE FROM rec_ingrediente WHERE IdRec={$this->IdRec} ;");
    }
}
