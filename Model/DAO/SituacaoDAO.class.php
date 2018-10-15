<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Situacao.class.php";

class SituacaoDAO
{
    private $conexao;

    public function __construct(\PDO $conexao) {
        $this->conexao=$conexao;
    }

    private function fillObject(&$linha)
    {
        $situacao=new \Model\Situacao();

        if(array_key_exists("idSituacao",$linha))
            $situacao->setIdSituacao($linha["idSituacao"]);
        if(array_key_exists("situacao",$linha))
            $situacao->setSituacao($linha["situacao"]);
        
        return $situacao;
    }

    public function listarTodos()
    {
        $consulta = "select * from situacao";
        $comando=$this->conexao->prepare($consulta);
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

    public function prontoParaSerialize()
    {
        return get_object_vars($this);
    }
}

?>