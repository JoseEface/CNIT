<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../LocalNaDe.class.php";

class LocalNaDeDAO
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao=$conexao;
    }

    private function fillObject(&$linha)
    {
        $localnade=new \Model\LocalNaDe();

        if(array_key_exists("idLocalNaDE",$linha))
            $localnade->setIdLocalNaDe($linha["idLocalNaDE"]);
        if(array_key_exists("local",$linha))
            $localnade->setLocal($linha["local"]);

        return $localnade;
    }

    public function listarTodos()
    {
        $consulta="select * from localnade";
        $comando=$this->conexao->prepare($consulta);
        $linha=null;
        $lista=array();

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha=$comando->fetch(\PDO::FETCH_ASSOC))
                    $lista[]=$this->fillObject($linha);
            }
        }

        return $lista;
    }
}

?>