<?php

require_once "libs/Database.php";

class Usuario
{
    private $IdUSu;
    private $Correo;
    private $NomUsu;
    private $Contraseña;

    public function __construct()
    {
    }

    /**
     * @return mixed $IdUSu
     */
    public function getIdUSu()
    {
        return $this->IdUSu;
    }

    /**
     * @return mixed $IdUSu
     */
    public function setIdUSu($IdUSu)
    {
        $this->IdUSu = $IdUSu;

        return $this;
    }
    /**
     * @return mixed $Correo
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * @return mixed $Correo
     */
    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;

        return $this;
    }
    /**
     * @return mixed $NomUsu
     */
    public function getNomUsu()
    {
        return $this->NomUsu;
    }

    /**
     * @return mixed $NomUsu
     */
    public function setNomUsu($NomUsu)
    {
        $this->NomUsu = $NomUsu;

        return $this;
    }
    
    /**
     * @return mixed $Contraseña
     */
    public function getContraseña()
    {
        return $this->Contraseña;
    }

    /**
     * @return mixed $Contraseña
     */
    public function setContraseña($Contraseña)
    {
        $this->Contraseña = $Contraseña;

        return $this;
    }

    public function save()
    {
        $db  = new BaseDeDatos();

        if (is_null($this->idUsu)) :

            $sql = "INSERT INTO usuario (Correo, NomUsu, ApeUsu, Contraseña) 
                                VALUES ('{$this->Correo}', '{$this->NomUsu}', '{$this->ApeUsu}', '{$this->Contraseña}') ;";


            $db->query($sql);

            $this->idUsu = $db->lastId();

        endif;

        return $this;
    }

    public function __toString()
    {
        return $this->NomUsu . " " . $this->ApeUsu;
    }
}
