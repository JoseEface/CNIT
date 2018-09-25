<?php

namespace Model;

class BuscaAtendimento
{
    private $idTecnico, $idSolicitacaoAtendimento, $idNit, $escolaNome, $tecnicoNome, $situacao;       

    /**
     * Get the value of idTecnico
     */ 
    public function getIdTecnico()
    {
        return $this->idTecnico;
    }

    /**
     * Set the value of idTecnico
     *
     * @return  self
     */ 
    public function setIdTecnico($idTecnico)
    {
        $this->idTecnico = $idTecnico;

        return $this;
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
     * Get the value of escolaNome
     */ 
    public function getEscolaNome()
    {
        return $this->escolaNome;
    }

    /**
     * Set the value of escolaNome
     *
     * @return  self
     */ 
    public function setEscolaNome($escolaNome)
    {
        $this->escolaNome = $escolaNome;

        return $this;
    }

    /**
     * Get the value of tecnicoNome
     */ 
    public function getTecnicoNome()
    {
        return $this->tecnicoNome;
    }

    /**
     * Set the value of tecnicoNome
     *
     * @return  self
     */ 
    public function setTecnicoNome($tecnicoNome)
    {
        $this->tecnicoNome = $tecnicoNome;

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
}

?>