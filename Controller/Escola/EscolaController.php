<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/EscolaDAO.class.php";
include_once dirname(__FILE__)."/../../Model/Escola.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson();

switch($acao)
{
    case "ListarNomeEscolas":
        $conexao=\Model\Connection\ConnectionFactory::getConnection();
        $escoladao=new \Model\DAO\EscolaDAO($conexao);
        
        $listaEscolas=$escoladao->ListarNomes();
        $retornoJson->setSucesso(true);
        $retornoJson->setMensagem("Escolas consultadas com sucesso");
        $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($listaEscolas));

        break;
    default:
        $retornoJson->setSucesso(false);
        $retornoJson->setMensagem("EscolaController: comando inválido para o controlador");
        $retornoJson->setDados(null);
}

echo json_encode($retornoJson->prontoParaSerialize());

?>