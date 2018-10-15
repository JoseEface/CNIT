<?php

include_once dirname(__FILE__)."/../../Model/Tecnico.class.php";
include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/TecnicoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";
include_once dirname(__FILE__)."/../../Controller/Acesso/LoginDefinitions.class.php";

header("Content-type: application/json");

$acao=filter_input(INPUT_POST,"acao");
$retornoJson=new Model\RetornoJson();

if(session_status() == PHP_SESSION_NONE)
    session_start();

try
{
    if($acao != null)
    {
        switch($acao)
        {
            case "login":
                $usuario=filter_input(INPUT_POST,"usuario",\FILTER_SANITIZE_STRING);
                $senha=filter_input(INPUT_POST,"senha");                

                if(isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR])) 
                {
                    $retornoJson->setSucesso(true);
                    $retornoJson->setMensagem("Você já está logado");
                    $retornoJson->setDados(null);
                    break;
                }

                if($usuario == null)
                    throw new \InvalidArgumentException("Parâmetro usuario inválido ou ausente.");

                $conexao=\Model\Connection\ConnectionFactory::getConnection();
                $tdao=new \Model\DAO\TecnicoDAO($conexao);
                
                $tecnico=$tdao->getTecnicoByLogin($usuario);
                if($tecnico != null && $tecnico->getSenha() == hash("sha256",$senha))
                {
                    //$senhaArmazenada=$tecnico->getSenha();
                    //if($senhaArmazenada == hash("sha256",$senha))
                    //{
                        $_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]=serialize($tecnico);
                        $retornoJson->setSucesso(true);
                        $retornoJson->setMensagem("Login efetuado com sucesso !");
                        $retornoJson->setDados(null);
                    //}
                    //else                    
                }
                else
                    throw new \InvalidArgumentException("Usuário e/ou senha inválidos.");

                break;

            case "logout":
                session_unset();
                session_destroy();
                $retornoJson->setSucesso(true);
                $retornoJson->setMensagem("Sessão finalizada com sucesso");
                $retornoJson->setDados(null);
                break;

            default:
                throw new \InvalidArgumentException("Ação inválida");
        }
    }
}
catch(\Exception $e)
{
    $retornoJson->setSucesso(false);
    $retornoJson->setMensagem($e->getMessage());
    $retornoJson->setDados(null);
}

echo json_encode($retornoJson->prontoParaSerialize());

?>