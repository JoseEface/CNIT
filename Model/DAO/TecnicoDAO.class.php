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

    public function retornaUnico($idtecnico)
    {
        $consulta = "select * from tecnico where idtecnico=:idtecnico";
        $tecnico = null;
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":idtecnico",$idtecnico,\PDO::PARAM_INT);

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                $linha=$comando->fetch(\PDO::FETCH_ASSOC);
                $tecnico=$this->fillObject($linha);
            }
        }
        else
            throw new \RuntimeException("retornaUnico: Falha ao retorna único técnico ".$comando->errorInfo()[2]);
        
        return $tecnico;
    }

    /** Assume-se que o hash sha256 deve ser feito antes de ser enviado para esse método **/
    public function editar(\Model\Tecnico $tecnico)
    {
        $edicao = "update tecnico set nome=:nome,login=:login,senha=:senha where idtecnico=:idtecnico";
        $comando = $this->conexao->prepare($edicao);
        $tecnicoAtual = $this->retornaUnico($tecnico->getIdTecnico());

        if($tecnico == null)
            throw new \RuntimeException("editar: Não foi encontrado técnico com o id informado");

        $comando->bindValue(":nome",$tecnico->getNome(),\PDO::PARAM_STR);
        $comando->bindValue(":login",$tecnico->getLogin(),\PDO::PARAM_STR);
        if($tecnicoAtual->getSenha() == $tecnico->getSenha())
            $comando->bindValue(":senha",$tecnico->getSenha(),\PDO::PARAM_STR);
        else
            $comando->bindValue(":senha",$tecnico->getSenha(),\PDO::PARAM_STR);
        $comando->bindValue(":idtecnico",$tecnico->getIdTecnico(),\PDO::PARAM_INT);
        
        if(!$comando->execute())
            throw new \RuntimeException("editar: Falha ao alterar dados do técnico: ".$comando->errorInfo()[2]);
        
        return true;
    }

    public function confereSenha($idtecnico, $senha)
    {
        $confere = "select idTecnico from tecnico where idTecnico=:idtecnico and senha=:senha";
        $comando = $this->conexao->prepare($comando);
        $comando->bindValue(":idtecnico",$idtecnico,\PDO::PARAM_INT);
        $comando->bindValue(":senha",$senha,\PDO::PARAM_STR);
        $resultado = 0;
        
        if($comando->execute())
            $resultado=$comando->rowCount();
        else    
            throw new \RuntimeException("confereSenha: Falha ao enviar comando para o banco de dados ".$comando->errorInfo()[2]);
        
        $comando->closeCursor();

        return $resultado != 0;
    }

    public function loginExiste($login) {
        $verifica = "select idTecnico from tecnico where login=:login";
        $comando = $this->conexao->prepare($verifica);

        $comando->bindValue(":login",$login,\PDO::PARAM_STR);
        $quantidade = 0;
        
        if($comando->execute())        
            $quantidade=$comando->rowCount();        
        else
            throw new \RuntimeException("loginExiste: Falha ao consultar banco de dados: ".$comando->errorInfo()[2]);        
        
        return $quantidade != null;
    }    
}

?>