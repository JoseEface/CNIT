<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/TecnicoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/Tecnico.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";


header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new Model\RetornoJson();

try
{
    switch($acao) 
    {
        case "getLista":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $tdao=new \Model\DAO\TecnicoDAO($conexao);
            $lista=$tdao->listarTodos();
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Lista retornada com sucesso");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));
            break;
        default:
            throw new \InvalidArgumentException("Ação especificada é inválida");
    }
}
catch(\Exception $e)
{
    $retornoJson->setSucesso(false);
    $retornoJson->setMensagem($e->getMessage());
    $retornoJson->setStatus(null);
}

echo json_encode($retornoJson->prontoParaSerialize());

?>