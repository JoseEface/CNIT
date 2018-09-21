<?php

namespace Model;

include_once dirname(__FILE__)."/Tecnico.class.php";
include_once dirname(__FILE__)."/Solucao.class.php";
include_once dirname(__FILE__)."/SolicitacaoAtendimento.class.php";
include_once dirname(__FILE__)."/LocalNaDe.class.php";

class Atendimento 
{
    private $tecnico, $idTecnico, $solicitacaoAtendimento,$idSolicitacaoAtendimento;
    private $descricaoSolucao, $localde, $idLocalNaDe, $situacao, $idSituacao, $dataFinalizado, $dataInicio;

    /**
     * Get the value of tecnico
     */ 
    public function getTecnico()
    {
        return $this->tecnico;
    }

    /**
     * Set the value of tecnico
     *
     * @return  self
     */ 
    public function setTecnico(Tecnico $tecnico)
    {
        $this->tecnico = $tecnico;

        return $this;
    }
    

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
     * Get the value of solicitacaoAtendimento
     */ 
    public function getSolicitacaoAtendimento()
    {
        return $this->solicitacaoAtendimento;
    }

    /**
     * Set the value of solicitacaoAtendimento
     *
     * @return  self
     */ 
    public function setSolicitacaoAtendimento(SolicitacaoAtendimento $solicitacaoAtendimento)
    {
        $this->solicitacaoAtendimento = $solicitacaoAtendimento;

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
     * Get the value of descricaoSolucao
     */ 
    public function getDescricaoSolucao()
    {
        return $this->descricaoSolucao;
    }

    /**
     * Set the value of descricaoSolucao
     *
     * @return  self
     */ 
    public function setDescricaoSolucao($descricaoSolucao)
    {
        $this->descricaoSolucao = $descricaoSolucao;

        return $this;
    }

    /**
     * Get the value of localde
     */ 
    public function getLocalde()
    {
        return $this->localde;
    }

    /**
     * Set the value of localde
     *
     * @return  self
     */ 
    public function setLocalde(LocalNaDe $localde)
    {
        $this->localde = $localde;

        return $this;
    }

    /**
     * Get the value of situacao
     */ 
    public function getIdLocalNaDe()
    {
        return $this->idLocalNaDe;
    }

    /**
     * Set the value of situacao
     *
     * @return  self
     */ 
    public function setIdLocalNaDe($idLocal)
    {
        $this->idLocalNaDe = $idLocal;

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
    public function setSituacao(Situacao $situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

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
     * Get the value of dataFinalizado
     */ 
    public function getDataFinalizado()
    {
        return $this->dataFinalizado;
    }

    /**
     * Set the value of dataFinalizado
     *
     * @return  self
     */ 
    public function setDataFinalizado(\DateTime $dataFinalizado)
    {
        $this->dataFinalizado = $dataFinalizado;

        return $this;
    }

    /**
     * Get the value of dataInicio
     */ 
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set the value of dataInicio
     *
     * @return  self
     */ 
    public function setDataInicio(\DateTime $dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }
}

?>