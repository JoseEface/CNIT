<?php

namespace Model;

class DonoAlternativo 
{
    private $idDonoAlternativo, $nome, $diretoria;    

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
     * Get the value of nome
     * @return string
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
     * Get the value of diretoria
     * @return Boolean
     */ 
    public function isDiretoria()
    {
        return $this->diretoria;
    }

    /**
     * Set the value of diretoria
     *
     * @return  self
     */ 
    public function setDiretoria($diretoria)
    {
        $this->diretoria = $diretoria;

        return $this;
    }
}

?>