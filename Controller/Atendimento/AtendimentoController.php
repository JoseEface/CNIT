<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/AtendimentoDAO.class.php";
include_once dirname(__FILE__)."/../../Model/Atendimento.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson();

try 
{
    switch($acao)
    {
        case "buscaAtendimento":
            /*TODO Terminar*/
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $tecnico=filter_input(INPUT_POST,"idtecnico",\FILTER_VALIDATE_INT);
            $idnit=filter_input(INPUT_POST,"idnit",\FILTER_SANITIZE_STRING);
            $situacao=filter_input(INPUT_POST,"idsituacao",\FILTER_VALIDATE_INT);

            /*if(is_null($tecnico) && is_null($idnit) && is_null($situacao))
                throw new \InvalidArgumentException("buscaAtendimento: definir ao menos uma variável para consulta");            */
            if(!is_null($tecnico) && !empty($tecnico) && $tecnico === false)
                throw new \InvalidArgumentException("buscaAtendimento: definir um tecnico válido");            
            if(!is_null($idnit) && !empty($idnit) && (strlen($idnit) > 10 || strlen($idnit == 0) ) )
                throw new \InvalidArgumentException("buscaAtendimento: definir um idnit válido ${idnit}");
            if(!is_null($situacao) && !empty($situacao) && $situacao === false)
                throw new \InvalidArgumentException("buscaAtendimento: definir um situacao válido");

            if($tecnico == "") $tecnico=null;
            if($idnit == "") $idnit=null;
            if($situacao == "") $situacao=null;

            $adao=new \Model\DAO\AtendimentoDAO($conexao);
            $lista=$adao->listaAtendimentoBusca($tecnico,$idnit,$situacao);
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados retornados com sucesso ! ${situacao}");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));

            break;

        case "adicionar":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $adao=new \Model\DAO\AtendimentoDAO($conexao);

            // Início da sequência de validação 
            
            $tecnico=filter_input(INPUT_POST,"novoTecnico",\FILTER_VALIDATE_INT);
            $satendimento=filter_input(INPUT_POST,"novaSolicitacaoAtendimento",\FILTER_VALIDATE_INT);
            $novolocal=filter_input(INPUT_POST,"novoLocalDE",\FILTER_VALIDATE_INT);
            $situacao=filter_input(INPUT_POST,"novaSituacao",\FILTER_VALIDATE_INT);
            $datainicio=filter_input(INPUT_POST,"novaDataInicio",\FILTER_SANITIZE_STRING);
            $datafinalizado=filter_input(INPUT_POST,"novaDataFinalizacao",\FILTER_SANITIZE_STRING);
            $descricaosolucao=filter_input(INPUT_POST,"novaDescricaoSolucao",\FILTER_SANITIZE_STRING);

            if($tecnico == null || $tecnico === false)
                throw new InvalidArgumentException("adicionar: tecnico inválido");
            if($satendimento == null || $satendimento === false)
                throw new InvalidArgumentException("adicionar: solicitação atendimento inválida");
            if($novolocal == null || $novolocal === false)  
                throw new InvalidArgumentException("adicionar: local na DE inválido");
            if($situacao == null || $situacao === false)
                throw new InvalidArgumentException("adicionar: situacao inválida");

            $datainicio=\DateTime::createFromFormat("d/m/Y",$datainicio, new \DateTimeZone("America/Sao_Paulo"));
            if(strlen($datafinalizado))
                $datafinalizado=\DateTime::createFromFormat("d/m/Y",$datafinalizado, new \DateTimeZone("America/Sao_Paulo"));
            else
                $datafinalizado=null;

            if($datainicio === false)
                throw new \InvalidArgumentException("adicionar: data de início inválida");
            if($datafinalizado === false)            
                throw new \InvalidArgumentException("adicionar: data de finalização inválida");
            if($descricaosolucao == null || !strlen($descricaosolucao) || $descricaosolucao === false)
                throw new \InvalidArgumentException("adicionar: descrição solução inválida");

            if(!$adao->verificaAtendimentoLivre($satendimento))
                throw new \InvalidArgumentException("adicionar: a solicitação fornecida já está sendo atendida");
            
            // Fim da sequência de validação 

            $atendimento=new \Model\Atendimento();
            $atendimento->setIdTecnico($tecnico);
            $atendimento->setIdSolicitacaoAtendimento($satendimento);
            $atendimento->setIdLocalNaDe($novolocal);
            $atendimento->setIdSituacao($situacao);
            $atendimento->setDataInicio($datainicio);
            $atendimento->setDataFinalizado($datafinalizado);
            $atendimento->setDescricaoSolucao($descricaosolucao);

            if(!$adao->adicionar($atendimento))
                throw new \RuntimeException("adicionar: Falha ao inserir no banco de dados.");

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Novo atendimento adicionado com sucesso.");
            $retornoJson->setDados(null);     
            break;

        case "carregarAtendimento":
            $idtecnico = filter_input(INPUT_POST,"idtecnico",\FILTER_VALIDATE_INT);
            $idsolicitacao = filter_input(INPUT_POST,"idsolicitacao",\FILTER_VALIDATE_INT);

            if($idtecnico == null || $idtecnico === false)
                throw new \InvalidArgumentException("carregarAtendimento: Falha ao receber idtecnico");
            if($idsolicitacao == null | $idsolicitacao === false)
                throw new \InvalidArgumentException("carregarAtendimento: Falha ao receber idsolicitacao");
            
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $adao=new \Model\DAO\AtendimentoDAO($conexao);
            $atendimento = $adao->retornaUnico($idtecnico,$idsolicitacao);

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Atendimento retornado com sucesso");
            if($atendimento != null)
                $retornoJson->setDados($atendimento->prontoParaSerialize());
            break;

        case "alterarAtendimento":
            $conexao=\Model\Connection\ConnectionFactory::getConnection();
            $adao=new \Model\DAO\AtendimentoDAO($conexao);

            $idtecnico = filter_input(INPUT_POST,"idtecnico",\FILTER_VALIDATE_INT);
            $idsolicitacao = filter_input(INPUT_POST,"idsolicitacao",\FILTER_VALIDATE_INT);
            $localde = filter_input(INPUT_POST,"localde",\FILTER_VALIDATE_INT);
            $situacao = filter_input(INPUT_POST,"situacao",\FILTER_VALIDATE_INT);
            $datainicio = filter_input(INPUT_POST,"datainicio",\FILTER_SANITIZE_STRING);
            $datafim = filter_input(INPUT_POST,"datafim",\FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST,"descricao",\FILTER_SANITIZE_STRING);

            if(strlen($datanicio))
                $datainicio=\DateTime::createFromFormat("d/m/Y",$datainicio,new DateTimeZone("America/Sao_Paulo"));
            else
                throw new \InvalidArgumentException("alterarAtendimento: falta a data de início.");
            
            if(strlen($datafim))
                $datafim=\DateTime::createFromFormat("d/m/Y",$datafinalizado, new \DateTimeZone("America/Sao_Paulo"));
            else
                $datafim=null;
            
            if($idtecnico == null || $idtecnico === false)
                throw new \InvalidArgumentException("alterarAtendimento: tecnico não especificado.");
            if($idsolicitacao == null || $idsolicitacao === false)
                throw new \InvalidArgumentException("alterarAtendimento: solicitação não especificada.");
            if($localde == null || $localde === false)  
                throw new \InvalidArgumentException("alterarAtendimento: falta o local da de.");
            if($situacao == null || $situacao === false)
                throw new \InvalidArgumentException("alterarAtendimento: falta a situação.");
            if($descricao == null || $descricao === false)
                throw new \InvalidArgumentException("alterarAtendimento: falta a descrição.");
            if($datainicio === false)
                throw new \InvalidArgumentException("alterarAtendimento: data de início em formato inválido.");
            if($datafim === false)    
                throw new \InvalidArgumentException("alterarAtendimento: data de fim em formato inválido.");
            
            $atendimento=new \Model\Atendimento();
            $atendimento->setIdTecnico($idtecnico);
            $atendimento->setIdSolicitacaoAtendimento($idsolicitacao);
            $atendimento->setIdLocalNaDe($localde);
            $atendimento->setIdSituacao($situacao);
            $atendimento->setDataInicio($datainicio);
            $atendimento->setDataFinalizado($datafim);
            $atendimento->setDescricaoSolucao($descricao);

            /**
             * AtendimentoController - testar função DAO
             */
            if(!$adao->editar($atendimento))
                throw new \RuntimeException("alterarAtendimento: edição não pode ser realizada no banco de dados.");
            
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Atendimento alterado com sucesso !");
            $retornoJson->setDados(null);

            break;
        default:
            throw new \InvalidArgumentException("adicionar: Comando inválido passado para o controlador");
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