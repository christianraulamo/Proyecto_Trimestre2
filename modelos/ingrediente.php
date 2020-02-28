<?php

require_once "libs/Database.php";

class Ingrediente
{
    private $IdIngrediente;
    private $IngredientePrincipal;

    public function __construct()
    {
    }

    /**
     * @return mixed $IdIngrediente
     */
    public function getIdIngrediente()
    {
        return $this->IdIngrediente;
    }

    /**
     * @return mixed $IdIngrediente
     */
    public function setIdIngrediente($IdIngrediente)
    {
        $this->IdIngrediente = $IdIngrediente;

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

    public static function findAll()
    {
        $db = new BaseDeDatos();
        $db->query("SELECT * From ingrediente");

        $data = [];
        while ($obj = $db->getObject("Ingrediente"))
            array_push($data, $obj);

        return $data;
    }
    

    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->IdIngrediente)) :

            $sql = "INSERT INTO ingrediente (IngredientePrincipal) 
                                VALUES ('{$this->IngredientePrincipal}') ;";


            $db->query($sql);

            $this->IdIngrediente = $db->lastId();

        endif;

        return $this;
    }
}
