<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Tecnico.class.php";

class TecnicoDAO
{
    private $conexao=null;

    public function __construct(\PDO $conexao)
    {
        $this->conexao=$conexao;
    }

    public function fillObject(&$linha)
    {
        $tecnico=new \Model\Tecnico();

        if(array_key_exists("idTecnico",$linha))
            $tecnico->setIdTecnico($linha["idTecnico"]);
        if(array_key_exists("nome",$linha))
            $tecnico->setNome($linha["nome"]);
        if(array_key_exists("login",$linha))
            $tecnico->setLogin($linha["login"]);
        if(array_key_exists("senha",$linha))
            $tecnico->setSenha($linha["senha"]);

        return $tecnico;
    }

    public function getTecnicoByLogin($login)
    {
        $consulta="select * from Tecnico where login=:login";
        $comando=$this->conexao->prepare($consulta);
        $comando->bindValue(":login",$login,\PDO::PARAM_STR);
        $usuario=null;

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                $resultado=$comando->fetch(\PDO::FETCH_ASSOC);
                $usuario=$this->fillObject($resultado);
            }
        }

        $comando->closeCursor();

        return $usuario;
    }

    public function listarTodos()
    {
        $consulta="select * from Tecnico";
        $comando=$this->conexao->prepare($consulta);
        $lista=array();

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($resultado=$comando->fetch(\PDO::FETCH_ASSOC))
                {
                    $tecnico=new \Model\Tecnico();
                    $tecnico->setIdTecnico($resultado["idTecnico"]);
                    $tecnico->setNome($resultado["nome"]);
                    $tecnico->setLogin($resultado["login"]);
                    $tecnico->setSenha($resultado["senha"]);
                    $lista[]=$tecnico;
                }   
            }
        }

        return $lista;
    }
}

?>