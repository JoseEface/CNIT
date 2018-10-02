<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/SolicitacaoAtendimentoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/SolicitacaoAtendimento.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";


header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new Model\RetornoJson();

try 
{
    switch($acao)
    {
        case "listarSemAtendimento":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $sadao=new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);
            $lista=$sadao->listarSolicitacoesLivres();
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Lista retornada com sucesso !");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));
            break;
        case "qtdSolicitacaoAtendimento":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $sadao=new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);

            $quantidade=$sadao->qtdSolicitacaoLivre();
            $retornoJson->setSucesso(false);
            $retornoJson->setMensagem("Quantidade consultada com sucesso.");
            $retornoJson->setDados($quantidade);
            break;
        default:
            throw new \InvalidArgumentException("Ação inválida para o controlador");
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