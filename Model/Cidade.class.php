<?php

namespace Model;

include_once dirname(__FILE__)."/Estado.class.php";

class Cidade
{
    private $idCidade,$estado,$idEstado;


    /**
     * Get the value of idCidade
     */ 
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * Set the value of idCidade
     *
     * @return  self
     */ 
    public function setIdCidade($idCidade)
    {
        $this->idCidade = $idCidade;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado(Estado $estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of idEstado
     */ 
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set the value of idEstado
     *
     * @return  self
     */ 
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }
}


?>