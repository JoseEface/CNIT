<?php

namespace Model;

class Estado
{
    private $idEstado, $nomeEstado, $sigla;

    /**
     * Get the value of idEstad
     */ 
    public function getIdEstado()
    {
        return $this->idEstad;
    }

    /**
     * Set the value of idEstad
     *
     * @return  self
     */ 
    public function setIdEstado($idEstad)
    {
        $this->idEstad = $idEstad;

        return $this;
    }

    /**
     * Get the value of nomeEstado
     */ 
    public function getNomeEstado()
    {
        return $this->nomeEstado;
    }

    /**
     * Set the value of nomeEstado
     *
     * @return  self
     */ 
    public function setNomeEstado($nomeEstado)
    {
        $this->nomeEstado = $nomeEstado;

        return $this;
    }

    /**
     * Get the value of sigla
     */ 
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set the value of sigla
     *
     * @return  self
     */ 
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }
}

?>