<?php

namespace Model;

class LocalNaDe 
{
    private $idLocalNaDe, $local;    

    /**
     * Get the value of idLocalNaDe
     */ 
    public function getIdLocalNaDe()
    {
        return $this->idLocalNaDe;
    }

    /**
     * Set the value of idLocalNaDe
     *
     * @return  self
     */ 
    public function setIdLocalNaDe($idLocalNaDe)
    {
        $this->idLocalNaDe = $idLocalNaDe;

        return $this;
    }

    /**
     * Get the value of local
     */ 
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set the value of local
     *
     * @return  self
     */ 
    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }

}


?>