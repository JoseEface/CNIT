<?php

namespace Model;

include_once dirname(__FILE__)."/Escola.class.php";
include_once dirname(__FILE__)."/DonoAlternativo.class.php";

class SolicitacaoAtendimento 
{
    private $idSolicitacaoAtendimento;
    private $dataAbertura, $idNit, $descricaoProblema, $escola, $idEscola, $donoAlternativo, $idDonoAlternativo, $nomeEntregador;    

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
     * Get the value of dataAbertura
     */ 
    public function getDataAbertura()
    {
        return $this->dataAbertura;
    }

    /**
     * Set the value of dataAbertura
     *
     * @return  self
     */ 
    public function setDataAbertura(\DateTime $dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;

        return $this;
    }

    /**
     * Get the value of idNit
     */ 
    public function getIdNit()
    {
        return $this->idNit;
    }

    /**
     * Set the value of idNit
     *
     * @return  self
     */ 
    public function setIdNit($idNit)
    {
        $this->idNit = $idNit;

        return $this;
    }

    /**
     * Get the value of descricaoProblema
     */ 
    public function getDescricaoProblema()
    {
        return $this->descricaoProblema;
    }

    /**
     * Set the value of descricaoProblema
     *
     * @return  self
     */ 
    public function setDescricaoProblema($descricaoProblema)
    {
        $this->descricaoProblema = $descricaoProblema;

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
    public function setEscola(Escola $escola)
    {
        $this->escola = $escola;

        return $this;
    }

    /**
     * Get the value of idEscola
     */ 
    public function getIdEscola()
    {
        return $this->idEscola;
    }

    /**
     * Set the value of idEscola
     *
     * @return  self
     */ 
    public function setIdEscola($idEscola)
    {
        $this->idEscola = $idEscola;

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
    public function setDonoAlternativo(DonoAlternativo $donoAlternativo)
    {
        $this->donoAlternativo = $donoAlternativo;

        return $this;
    }

    /**
     * Get the value of idDonoAlternativo
     */ 
    public function getIdDonoAlternativo()
    {
        return $this->idDonoAlternativo;
    }

    /**
     * Set the value of idDonoAlternativo
     *
     * @return  self
     */ 
    public function setIdDonoAlternativo($idDonoAlternativo)
    {
        $this->idDonoAlternativo = $idDonoAlternativo;

        return $this;
    }

    /**
     * Get the value of nomeEntregador
     */ 
    public function getNomeEntregador()
    {
        return $this->nomeEntregador;
    }

    /**
     * Set the value of nomeEntregador
     *
     * @return  self
     */ 
    public function setNomeEntregador($nomeEntregador)
    {
        $this->nomeEntregador = $nomeEntregador;

        return $this;
    }

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }

}


?>