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

echo filter_var("03/04/2018",\FILTER_SANITIZE_STRING);

echo "testando";
$datapadrao=new \DateTime("02/03/2018",new \DateTimeZone("America/Sao_Paulo"));
$datapadrao= \DateTime::createFromFormat("Y-m-d H:i:s", '2009-02-15 00:00:00', new \DateTimeZone("America/Sao_Paulo"));
$datapadrao= \DateTime::createFromFormat("d/m/Y","02/02/2018", new \DateTimeZone("America/Sao_Paulo"));
echo $datapadrao->format("d/m/Y");

$teste = new \DateTime("adfasfdsdaf",new \DateTimeZone("America/Sao_Paulo"));
print_r($teste);

/*
//$conexao = \Model\Connection\ConnectionFactory::getConnection();
print_r((new \Model\DAO\SolicitacaoAtendimentoDAO(\Model\Connection\ConnectionFactory::getConnection()))->listarSolicitacoesLivres());
*/



?>