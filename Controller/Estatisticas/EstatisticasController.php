<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson();

try
{
    switch($acao)
    {
        case "SolicitacoesDiaMes":
            $mes = filter_input(\INPUT_POST,"mes",\FILTER_VALIDATE_INT);
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $esdao = new \Model\DAO\EstatisticaDAO();
            $lista=$esdao->QtdSolicitacoesDiaMes($mes);

            if($mes === null || $mes === false || $mes <= 0 || $mes > 12)
                throw new \InvalidArgumentException("SolicitacoesDiaMes: Número do mês inválido");

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Consulta realizada com sucesso");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));

            break;
        default:
            throw new \InvalidArgumentException("EstatisticaController: Comando inválido para o controlador");
    }
}
catch(\Exception $e)
{
    $retornoJson->setSucesso(true);
    $retornoJson->setMensagem($e->getMessage());
    $retornoJson->setDados(null);
}

echo json_encode();

?>