<?php

require_once "libs/Database.php";

class Rec_Ingrediente
{
    private $IdIngrediente;
    private $IdRec;

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


    public function save()
    {
        $db  = new BaseDeDatos();


        $sql = "INSERT INTO rec_ingrediente (IdRec, IdIngrediente) 
                                VALUES ('{$this->IdRec}','{$this->IdIngrediente}') ;";

        $db->query($sql);



        return $this;
    }
}
