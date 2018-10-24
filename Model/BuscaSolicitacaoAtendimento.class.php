<?php

namespace Model;

class BuscaSolicitacaoAtendimento
{
    private $dataAbertura,$idSolicitacaoAtendimento,$escola,$donoAlternativo;

    public function setDataAbertura(\DateTime $dataAbertura)
    {
        $this->dataAbertura=$dataAbertura;
    }

    public function getDataAbertura()
    {
        return $dataAbertura;
    }

    /**
     * Get the value of idSolicitacaoAtendimento
     */ 
    public function getIdSolicitacaoAtendimento()
    {
        return $this->idSolicitacaoAtendimento;
    }

    /**
     * Set the value of idSolicitacaoAtendimento
     *
     * @return  self
     */ 
    public function setIdSolicitacaoAtendimento($idSolicitacaoAtendimento)
    {
        $this->idSolicitacaoAtendimento = $idSolicitacaoAtendimento;

        return $this;
    }

    /**
     * Get the value of escola
     */ 
    public function getEscola()
    {
        return $this->escola;
    }

    /**
     * Set the value of escola
     *
     * @return  self
     */ 
    public function setEscola($escola)
    {
        $this->escola = $escola;

        return $this;
    }

    /**
     * Get the value of donoAlternativo
     */ 
    public function getDonoAlternativo()
    {
        return $this->donoAlternativo;
    }

    /**
     * Set the value of donoAlternativo
     *
     * @return  self
     */ 
    public function setDonoAlternativo($donoAlternativo)
    {
        $this->donoAlternativo = $donoAlternativo;

        return $this;
    }

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }

}
?>