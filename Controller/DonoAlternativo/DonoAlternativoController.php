<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/DonoAlternativoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/DonoAlternativo.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson();

try 
{
    switch($acao)
    {
        case "ProcurarDono":
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $dadao = new \Model\DAO\DonoAlternativoDAO($conexao);

            $dono = filter_input(INPUT_POST,"dono",\FILTER_SANITIZE_STRING);

            if(empty($dono))
                throw new \InvalidArgumentException("ProcurarDono: ausência de dono para a ação");

            $lista = $dadao->buscar($dono);
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Lista consultado com sucesso !");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));

            break;
        default:
            throw new \InvalidArgumentException("DonoAlternativo: Falta de parâmetros para o controller");
    }
}
catch(\Exception $e)
{
    $retornoJson->setSucesso(true);
    $retornoJson->setMensagem($e->getMessage());
    $retornoJson->setDados(null);
}

echo json_encode($retornoJson->prontoParaSerialize());

?>