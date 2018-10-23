<?php

namespace Model;

include_once dirname(__FILE__)."/Cidade.class.php";

class Escola 
{
    private $idEscola, $nome, $cie, $ua, $endereco, $cidade, $idCidade, $foneA, $foneB;


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
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cie
     */ 
    public function getCie()
    {
        return $this->cie;
    }

    /**
     * Set the value of cie
     *
     * @return  self
     */ 
    public function setCie($cie)
    {
        $this->cie = $cie;

        return $this;
    }

    /**
     * Get the value of ua
     */ 
    public function getUa()
    {
        return $this->ua;
    }

    /**
     * Set the value of ua
     *
     * @return  self
     */ 
    public function setUa($ua)
    {
        $this->ua = $ua;

        return $this;
    }

    /**
     * Get the value of endereco
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of cidade
     */ 
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade(Cidade $cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

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
     * Get the value of foneA
     */ 
    public function getFoneA()
    {
        return $this->foneA;
    }

    /**
     * Set the value of foneA
     *
     * @return  self
     */ 
    public function setFoneA($foneA)
    {
        $this->foneA = $foneA;

        return $this;
    }

    /**
     * Get the value of foneB
     */ 
    public function getFoneB()
    {
        return $this->foneB;
    }

    /**
     * Set the value of foneB
     *
     * @return  self
     */ 
    public function setFoneB($foneB)
    {
        $this->foneB = $foneB;

        return $this;
    }

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }
}

?>