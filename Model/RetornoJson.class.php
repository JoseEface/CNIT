<?php

namespace Model;

class RetornoJson
{
    private $mensagem, $dados, $sucesso;
    

    /**
     * Get the value of mensagem
     */ 
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * Set the value of mensagem
     *
     * @return  self
     */ 
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    /**
     * Get the value of dados
     */ 
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Set the value of dados
     *
     * @return  self
     */ 
    public function setDados($dados)
    {
        $this->dados = $dados;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getSucesso()
    {
        return $this->sucesso;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setSucesso($status)
    {
        $this->sucesso = $status;

        return $this;
    }

    public static function prepareArraySerialize(&$novo)
    {
        $lista=array();
        if(is_array($novo))
        {
            foreach($novo as $objeto)
                $lista[]=$objeto->prontoParaSerialize();
        }
        return $lista;
    }

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }
}

?>