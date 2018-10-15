<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/SituacaoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/Situacao.class.php";
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
            $sdao=new \Model\DAO\SituacaoDAO($conexao);
            $lista=$sdao->listarTodos();
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Lista retornada com sucesso");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));
            break;
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