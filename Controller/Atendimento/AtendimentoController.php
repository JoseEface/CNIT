<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/AtendimentoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/Atendimento.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new Model\RetornoJson();

try 
{
    switch($acao)
    {
        case "buscaAtendimento":
            /*TODO Terminar*/
            /*
            $nome=filter_input(INPUT_POST,"idtecnico",\FILTER_VALIDATE_INT);
            $idnit=filter_input(INPUT_POST,"idnit",\FILTER_VALIDATE_INT);
            $situacao=filter_input(INPUT_POST,"idsituacao",\FILTER_VALIDATE_INT);

            if(is_null($nome) && is_null($idnit) && is_null($situacao))
                throw new \InvalidArgumentException("buscaAtendimento: definir ao menos uma variável para consulta");
            
            if(!is_null($idnit) && !empty($nome) && (!($nome === 0) || !($nome) ) )
                throw new \InvalidArgumentException("buscaAtendimento: definir um nome válido");
            
            if(!is_null($idnit) && !empty($idnit) && (!($idnit === 0) || !($idnit) ) )
                throw new \InvalidArgumentException("buscaAtendimento: definir um idnit válido");

            if(!is_null($situacao) && !empty($situacao) && (!($situacao === 0) || !($situacao) ))
                throw new \InvalidArgumentException("buscaAtendimento: definir um situacao válido");
            */
            break;
    }
}
catch(\Exception $e)
{
    $retornoJson->setSucesso(false);
    $retornoJson->setMensagem($e->getMessage());
    $retornoJson->setDados(null);
}

?>