<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Escola.class.php";

class EscolaDAO
{
    private $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao=$conexao;
    }

    public function fillObject(&$linha)
    {
        $escola=new \Model\Escola();

        if(array_key_exists("idEscola",$linha))
            $escola->setIdEscola($linha["idEscola"]);
        if(array_key_exists("cie",$linha))
            $escola->setCie($linha["cie"]);
        if(array_key_exists("ua",$linha))
            $escola->setUa($linha["ua"]);
        if(array_key_exists("endereco",$linha))
            $escola->setEndereco($Linha["endereco"]);
        if(array_key_exists("idCidade",$linha))
            $escola->setIdCidade($linha["idCidade"]);
        if(array_key_exists("foneA",$linha))
            $escola->setFoneA($linha["foneA"]);
        if(array_key_exists("foneB",$linha))
            $escola->setFoneB($linha["foneB"]);
        
        return $escola;
    }

    public function ListarNomes()
    {
        $consulta="select idEscola,nome from escola";
        $comando=$this->conexao->prepare($consulta);
        $listaEscolas=array();
        $escola=null;

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha=$comando->fetch(\PDO::FETCH_ASSOC))
                {
                    $escola=new \Model\Escola();
                    $escola->setIdEscola($linha["idEscola"]);
                    $escola->setNome($linha["nome"]);
                    $listaEscolas[]=$escola;
                }
            }
        }
        else
        {
            $comando->closeCursor();
            throw new \RuntimeException("Escolas: Falha ao consultar banco de dados: ".$comando->errorInfo());
        }
        
        $comando->closeCursor();
        return $listaEscolas;
    }
}


?>