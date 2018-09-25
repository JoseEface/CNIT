<?php


echo "teste de texto a";

include_once "Model/SolicitacaoAtendimento.class.php"; 
include_once "Model/DAO/SolicitacaoAtendimentoDAO.class.php";
include_once "Model/Connection/ConnectionFactory.class.php";

echo "teste de texto";

$conexao = \Model\Connection\ConnectionFactory::getConnection();
$comando=$conexao->prepare("select * from SolicitacaoAtendimento where 1=1 and idNit=:idNit");
$comando->bindValue(":idNit",1,\PDO::PARAM_INT);
$comando->bindValue(":idsituacao",1,\PDO::PARAM_INT);
$comando->bindValue(":idtecnico",null,\PDO::PARAM_INT);


echo "testando";
/*
//$conexao = \Model\Connection\ConnectionFactory::getConnection();
print_r((new \Model\DAO\SolicitacaoAtendimentoDAO(\Model\Connection\ConnectionFactory::getConnection()))->listarSolicitacoesLivres());
*/



?>