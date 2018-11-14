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
        case "ListarTodas":
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);

            $lista=$sadao->buscar(null,null,null);
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados retornado com sucesso !");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));

            break;
        case "BuscaSolicitacoesLivres":
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);

            $lista = $sadao->BuscaSolicitacoesLivres();

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados retornados com sucesso");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));

            break;
        case "QtdSolicitacaoLivre":
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);
            $quantidade = $sadao->qtdSolicitacaoLivre();
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Quantidade retornada com sucesso");
            $retornoJson->setDados($quantidade);
            break;
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
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Quantidade consultada com sucesso.");
            $retornoJson->setDados($quantidade);
            break;
        case "AdicionarSolicitacao":
            $conexao = null;
            $sadao = null;

            //$idsolicitacao=filter_input(INPUT_POST,"idsolicitacao",\FILTER_VALIDATE_INT);
            $dataabertura=filter_input(INPUT_POST,"dataabertura",\FILTER_SANITIZE_STRING);
            $idnit=filter_input(INPUT_POST,"idnit",\FILTER_SANITIZE_STRING);
            $descricaoproblema=filter_input(INPUT_POST,"descricaoproblema",\FILTER_SANITIZE_STRING);
            $idescola=filter_input(INPUT_POST,"idescola",\FILTER_VALIDATE_INT);
            $iddonoalternativo=filter_input(INPUT_POST,"iddonoalternativo",\FILTER_VALIDATE_INT);
            $nomeentregador=filter_input(INPUT_POST,"nomeentregador",\FILTER_SANITIZE_STRING);

            /*if(!is_null($idsolicitacao) && !empty($idsolicitacao) && $idsolicitacao === false )
                throw new InvalidArgumentException("NovaSolicitacao: Id Solicitacao é inválida");*/
            if(is_null($idnit) || !strlen($idnit) || $idnit === false)
                throw new InvalidArgumentException("NovaSolicitacao: Id nit inválida");
            if(is_null($descricaoproblema) || empty($descricaoproblema) || $descricaoproblema === false)
                throw new InvalidArgumentException("NovaSolicitacao: Descricao do problema inválida");
            if(is_null($nomeentregador) || empty($nomeentregador) || $nomeentregador === false)
                throw new InvalidArgumentException("NovaSolicitacao: Nome entregador é inválido");
            if(is_null($dataabertura) || empty($dataabertura) || $dataabertura === false)
                throw new InvalidArgumentException("NovaSolicitacao: Data de abertura é inválida.");
            else
                $dataabertura=\DateTime::createFromFormat("d/m/Y",$dataabertura, new \DateTimeZone("America/Sao_Paulo"));
            
            if($dataabertura === false)
                throw new InvalidArgumentException("NovaSolicitação: data de abertura inválida.");
            if(($idescola == null && $iddonoalternativo == null) || (empty($idescola) && empty($iddonoalternativo)) || (!empty($idescola)  && !empty($iddonoalternativo)))
                throw new InvalidArgumentException("NovaSolicitacao: ou idescola ou iddonoalternativo devem ser definidos");
            if($iddonoalternativo == null)
            { 
                if(empty($idescola) || $idescola === false)
                    throw new InvalidArgumentException("NovaSolicitacao: Optado por idescola mas valor inválido.");
            }
            else
            {
                if(empty($iddonoalternativo) || $iddonoalternativo === false)
                    throw new InvalidArgumentException("NovaSolicitacao: Optado por iddonoalternativo mas valor inválido.");
            }

            if(empty($idescola))
                $idescola=null;
            if(empty($iddonoalternativo))
                $iddonoalternativo=null;

            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);
            
            $novasolictacao=new \Model\SolicitacaoAtendimento();            
            $novasolictacao->setIdSolicitacaoAtendimento(/*$idsolicitacao*/0);
            $novasolictacao->setDataAbertura($dataabertura);
            $novasolictacao->setIdNit($idnit);
            $novasolictacao->setDescricaoProblema($descricaoproblema);
            $novasolictacao->setIdEscola($idescola);
            $novasolictacao->setIdDonoAlternativo($iddonoalternativo);
            $novasolictacao->setNomeEntregador($nomeentregador);

            $sadao->adicionar($novasolictacao);

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Solicitação cadastrada com sucesso !");
            $retornoJson->setDados(null);

            break;
        case "RemoverSolicitacao":
            $conexao = null;
            $sadao = null;

            $idsolicitacao = filter_input(INPUT_POST,"idsolicitacao",FILTER_VALIDATE_INT);

            if($idsolicitacao == null || $idsolicitacao === false || $idsolicitacao == 0)
                throw new \InvalidArgumentException("RemoverSolicitação: ausência de id de solicitação");
            
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);
            
            $sadao->remover($idsolicitacao);

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Solicitação removida com sucesso !");
            $retornoJson->setDados(null);
    
            break;
        case "BuscarSolicitacao":
            $conexao = null;
            $sadao = null;

            $idescola = filter_input(INPUT_POST,"escola",\FILTER_VALIDATE_INT);
            $dataabertura = filter_input(INPUT_POST,"dataabertura",\FILTER_SANITIZE_STRING);
            $idnit = filter_input(INPUT_POST,"idnit",\FILTER_SANITIZE_STRING);

            if($idescola === null && $dataabertura === null && $idnit === null)
                throw new InvalidArgumentException("Ausência de parâmetros no controlador");
            if($dataabertura != null && strlen($dataabertura))
                $dataabertura = \DateTime::createFromFormat("d/m/Y",$dataabertura,new \DateTimeZone("America/Sao_Paulo"));
            else
                $dataabertura = null;    
            if($idescola != null && !strlen($idescola))
                $idescola = null;
            if($idnit != null && !strlen($idnit))
                $idnit = null;
            if($dataabertura === false)
                $dataabertura=null;
            
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);  
            $lista=array();
            $lista=$sadao->buscar($idescola, $idnit, $dataabertura);
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados retornado com sucesso !");
            $retornoJson->setDados(\Model\RetornoJson::prepareArraySerialize($lista));
            break;
        case "CarregarSolicitacao":
            $conexao = null;
            $sadao = null;

            $idsolicitacao=filter_input(INPUT_POST,"idsolicitacao",\FILTER_VALIDATE_INT);
            if($idsolicitacao == null || $idsolicitacao === false || $idsolicitacao === 0)
                throw new \InvalidArgumentException("CarregarSolicitacao: id de solicitação é inválido");
           
            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);  
            $solicitacao=$sadao->retornaUnico($idsolicitacao);

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Solicitação carregada com sucesso !");
            $retornoJson->setDados($solicitacao->prontoParaSerialize());
            
            break;     
        case "EditarSolicitacao":
            $conexao=null;
            $sadao=null;
            
            $idsolicitacao=filter_input(INPUT_POST,"idsolicitacao",\FILTER_VALIDATE_INT);
            $dataabertura=filter_input(INPUT_POST,"dataabertura",\FILTER_SANITIZE_STRING);
            $idnit=filter_input(INPUT_POST,"idnit",\FILTER_SANITIZE_STRING);
            $descricaoproblema=filter_input(INPUT_POST,"descricaoproblema",\FILTER_SANITIZE_STRING);
            $idescola=filter_input(INPUT_POST,"idescola",\FILTER_VALIDATE_INT);
            $iddonoalternativo=filter_input(INPUT_POST,"iddonoalternativo",\FILTER_VALIDATE_INT);
            $nomeentregador=filter_input(INPUT_POST,"nomeentregador",\FILTER_SANITIZE_STRING);

            if($idsolicitacao == null || $idsolicitacao === false || !strlen($idsolicitacao))
                throw new InvalidArgumentException("EditarSolicitação: ausência de id solicitação");
            if(empty($dataabertura))
                throw new InvalidArgumentException("EditarSolicitação: ausência de data de abertura");
            else                
                $dataabertura=\DateTime::createFromFormat("d/m/Y",$dataabertura,new \DateTimeZone("America/Sao_Paulo"));
            if($dataabertura === false) 
                throw new \InvalidArgumentException("EditarSolicitação: data de abertura em formato inválido.");
            if(empty($idnit))
                throw new \InvalidArgumentException("EditarSolicitação: id do nit é um campo obrigatório");
            if(empty($descricaoproblema))
                throw new \InvalidArgumentException("EditarSolicitação: descrição do problema é item obrigatório");
            if( (empty($idescola) && empty($iddonoalternativo)) || (!empty($idescola) && !empty($iddonoalternativo)) )
                throw new \InvalidArgumentException("EditarSolicitação: ou id da escola deve ser definido ou o id do dono $idescola $iddonoalternativo");
            if(empty($nomeentregador))
                throw new \InvalidArgumentException("EditarSolicitação: é necessário definir um nome de entregador");
          
            if(empty($idescola))
                $idescola=null;
            if(empty($iddonoalternativo))
                $iddonoalternativo=null;

            $conexao = \Model\Connection\ConnectionFactory::getConnection();
            $sadao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);  
    
            $solicitacao = new \Model\SolicitacaoAtendimento();
            $solicitacao->setIdSolicitacaoAtendimento($idsolicitacao);
            $solicitacao->setDataAbertura($dataabertura);
            $solicitacao->setIdNit($idnit);
            $solicitacao->setDescricaoProblema($descricaoproblema);
            $solicitacao->setIdEscola($idescola);
            $solicitacao->setIdDonoAlternativo($iddonoalternativo);
            $solicitacao->setNomeEntregador($nomeentregador);
            $sadao->editar($solicitacao);   
            
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Dados atualizados com sucesso");
            $retornoJson->setDados(null);

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