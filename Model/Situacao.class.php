<?php

namespace Model;

class Situacao 
{
    private $idSituacao, $situacao;


    /**
     * Get the value of idSituacao
     */ 
    public function getIdSituacao()
    {
        return $this->idSituacao;
    }

    /**
     * Set the value of idSituacao
     *
     * @return  self
     */ 
    public function setIdSituacao($idSituacao)
    {
        $this->idSituacao = $idSituacao;

        return $this;
    }

    /**
     * Get the value of situacao
     */ 
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     *
     * @return  self
     */ 
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }
    
    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }

}

?>