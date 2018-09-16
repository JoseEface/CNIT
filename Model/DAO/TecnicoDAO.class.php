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
                $usuario=new \Model\Tecnico();                
                $usuario->setIdTecnico($resultado["idTecnico"]);
                $usuario->setNome($resultado["nome"]);
                $usuario->setLogin($resultado["login"]);
                $usuario->setSenha($resultado["senha"]);
            }
        }

        $comando->closeCursor();

        return $usuario;
    }
}

?>