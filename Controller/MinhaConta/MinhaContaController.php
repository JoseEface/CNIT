<?php

include_once dirname(__FILE__)."/../../Model/Connection/ConnectionFactory.class.php";
include_once dirname(__FILE__)."/../../Model/DAO/SolicitacaoAtendimentoDAO.class.php";
include_once dirname(__FILE__)."/../Acesso/LoginDefinitions.class.php";
include_once dirname(__FILE__)."/../../Model/RetornoJson.class.php";
include_once dirname(__FILE__)."/../../Model/Tecnico.class.php";

header("Content-type: application/json");
$acao=filter_input(INPUT_POST,"acao");
$retornoJson= new \Model\RetornoJson();

if(session_status() == PHP_SESSION_NONE)
    session_start();

try
{
    switch($acao)
    {
        case "QtdMinhasSolicitacoes":
            if(isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
            {
                $tecnico=unserialize($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]);
                $conexao = \Model\Connection\ConnectionFactory::getConnection();
                $sdao = new \Model\DAO\SolicitacaoAtendimentoDAO($conexao);      
                
                $quantidade = $sdao->qtdSolicitacoesPorTecnico($tecnico->getIdTecnico());
                
                $retornoJson->setSucesso(true);
                $retornoJson->setMensagem("Consulta realizada com sucesso !");
                $retornoJson->setDados($quantidade);
            }
            else    
                throw new \RuntimeException("MinhaContaController: Nenhum sessão iniciada");
            break;
        case "AlterarPerfil":
            if(isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
            {
                $tecnico=unserialize($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]);
                $conexao = \Model\Connection\ConnectionFactory::getConnection();
                $tdao = new \Model\DAO\TecnicoDAO($conexao);                        
            
                $nomeTecnico = filter_input(INPUT_POST,"nome",\FILTER_SANITIZE_STRING);
                $login = filter_input(INPUT_POST,"login",\FILTER_SANITIZE_STRING);
                $senhaAtual = filter_input(INPUT_POST,"senhaAtual",\FILTER_SANITIZE_STRING);
                $senhaNova = filter_input(INPUT_POST,"senhaNova",\FILTER_SANITIZE_STRING);
                $senhaConfirma = filter_input(INPUT_POST,"senhaConfirma",\FILTER_SANITIZE_STRING);

                if(empty($nomeTecnico))
                    throw new \InvalidArgumentException("AlterarPerfil: o nome do técnico é obrigatório");
                if(empty($login))
                    throw new \InvalidArgumentException("AlterarPerfil: o login é um valor obrigatório");
                if(empty($senhaAtual) && (!empty($senhaNova) || !empty($senhaConfirma)))
                    throw new \RuntimeException("AlterarPerfilA: é necessário definir todas as senhas caso deseje trocar");
                if(empty($senhaNova) && (!empty($senhaAtual) || !empty($senhaConfirma)))
                    throw new \RuntimeException("AlterarPerfilN: é necessário definir todas as senhas caso deseje trocar");
                if(empty($senhaConfirma) && (!empty($senhaAtual) || !empty($senhaNova)))
                    throw new \RuntimeException("AlterarPerfilC: é necessário definir todas as senhas caso deseje trocar");
                if(empty($senhaAtual) && empty($senhaConfirma) && empty($senhaNova))            
                    $senhaAtual=$senhaConfirma=$senhaNova=null;
                else
                {
                    if(hash("sha256",$senhaAtual) != $tecnico->getSenha())
                        throw new \RuntimeException("AlterarPerfil: A senha atual informada não confere com o usuário");
                    if($senhaConfirma != $senhaNova)
                        throw new \RuntimeException("AlterarPerfil: A senha de confirmação é diferente da senha nova");
                }            
                
                $tecnico->setNome($nomeTecnico);
                $tecnico->setLogin($login);
                if($senhaNova != null)
                    $tecnico->setSenha(hash("sha256",$senhaNova));     
                $tdao->editar($tecnico);       
                $_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]=serialize($tecnico);
            }
            else   
                throw new \RuntimeException("AlterarPerfil: Nenhuma informação disponível para alterar login");
        
            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Perfil alterado com sucesso !");
            $retornoJson->setDados(null);

            break;
        case "SenhaConfere":

            if(!isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
                throw new \RuntimeException("MinhaContaController: Nenhum sessão iniciada !");

            $tecnicoLogado = unserialize($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]);

            $senha=filter_input(INPUT_POST,"senha");
            if(empty($senha))
                throw new \InvalidArgumentException("MinhaContaController: É necessário fornecer uma senha para conferir");

            $retornoJson->setSucesso(true);
            $retornoJson->setMensagem("Senha conferida");
            $retornoJson->setDados($tecnicoLogado->getSenha() == hash("sha256",$senha));

            break;
        case "LoginExiste":            
            $conexao = null;
            $tdao = null;
            $loginExiste=false;

            if(!isset($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]))
                throw new \RuntimeException("MinhaContaController: Nenhuma sessão iniciada !");
            
            $tecnicoLogado = unserialize($_SESSION[\Controller\Acesso\LoginDefinitions::SESSION_LOGIN_VAR]);
            $login = filter_input(INPUT_POST,"login",FILTER_SANITIZE_STRING);
            
            if(empty($login))
                throw new \InvalidArgumentException("MinhaContaController: Login não fornecido.");
            if($tecnicoLogado->getLogin() != $login)
            {
                $conexao = \Model\Connection\ConnectionFactory::getConnection();
                $tdao = new \Model\DAO\TecnicoDAO($conexao);
                $loginExiste = $tdao->loginExiste($login);
            }
            
            $retornoJson->setSucesso(true);
            if($loginExiste)
                $retornoJson->setMensagem("Login conferido com sucesso VERDADE!");
            else
                $retornoJson->setMensagem("Login conferido com sucesso FALSO!");
            $retornoJson->setDados($loginExiste);

            break;
        default: 
            throw new \InvalidArgumentException("AlterarPerfil: Comando inválido para o controlador");
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