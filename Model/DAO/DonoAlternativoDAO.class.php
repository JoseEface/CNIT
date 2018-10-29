<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DonoAlternativo.class.php";

class DonoAlternativoDAO
{
    private $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao=$conexao;
    }

    public function fillObject(&$linha)
    {
        $donoalternativo = new \Model\DonoAlternativo();

        if(array_key_exists("idDonoAlternativo",$linha))
            $donoalternativo->setIdDonoAlternativo($linha["idDonoAlternativo"]);
        if(array_key_exists("nome",$linha))
            $donoalternativo->setNome($linha["nome"]);
        if(array_key_exists("diretoria",$linha))
            $donoalternativo->setDiretoria($linha["diretoria"]);

        return $donoalternativo;
    }

    public function buscar($nome)
    {
        $consulta = "select * from donoalternativo where nome like :nome";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":nome","%".$nome."%",\PDO::PARAM_STR);
        $lista = array();

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha=$comando->fetch(\PDO::FETCH_ASSOC))                 
                    $lista[]=$this->fillObject($linha);                
            }
        }
        else    
            throw new \RuntimeException("DonoAlternativoDAO: Falha ao executar comando no banco de dados: ".$comando->errorInfo()[2]);
        
        return $lista;
    }
}

?>