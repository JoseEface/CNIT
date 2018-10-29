<?php

include_once dirname(__FILE__)."/../../Model/Tecnico.class.php";
include_once dirname(__FILE__)."/../Acesso/LoginDefinitions.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson(); 

try 
{
    switch($acao)
    {
        case "CarregarPerfil":
            if(session_status() == PHP_SESSION_NONE)
                session_start();
            if(!isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
                throw new \RuntimeException("IncialController: Nenhum usuário definido");
            
            $tecnico=unserialize($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]);
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Retornando dados com sucesso !");
            $retornoJson->setDados($tecnico->prontoParaSerialize());

            break;        
        default:
            throw new \InvalidArgumentException("InicialController: comando inválido para o controlador.");
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