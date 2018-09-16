<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Estado.class.php";

class EstadoDAO 
{
    private $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao=$conexao;
    }

    public function listarTodos()
    {
        $consulta="select * from Estado";
        $comando=$this->conexao->prepare($consulta);
        $linha=null;
        $lista=array();
        $estado=null;

        if($comando->execute())
        {
            while($linha=$comando->fetch(\PDO::FETCH_ASSOC))
            {
                $estado=new \Model\Estado();
                $estado->setIdEstado($linha["idEstado"]);
                $estado->setNomeEstado($linha["estado"]);
                $estado->setSigla($linha["sigla"]);
                $lista[]=$estado;
            }
        }

        return $lista;
    }

}