<?php

include_once dirname(__FILE__)."/../../Model/LocalNaDe.class.php";
include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/LocalNaDeDAO.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");

$acao=filter_input(INPUT_POST,"acao");
$retornoJson=new \Model\RetornoJson();

try
{
    
    switch($acao)
    {
        case "getLista":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $ldao=new \Model\DAO\LocalNaDeDAO($conexao);
            $lista=$ldao->listarTodos();            
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados retornados com sucesso");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));
            break;
        default:
            throw new \InvalidArgumentException("Comando inválido para o controlador");
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