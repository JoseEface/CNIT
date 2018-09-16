<?php

namespace Model;

class Tecnico 
{
    private $idTecnico, $nome, $login, $senha;

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
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
}

?>