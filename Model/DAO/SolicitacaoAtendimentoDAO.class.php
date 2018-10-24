<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../SolicitacaoAtendimento.class.php";
include_once dirname(__FILE__)."/../BuscaSolicitacaoAtendimento.class.php";

class SolicitacaoAtendimentoDAO 
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao=$conexao;
    }

    private function fillObject(&$linha)
    {
        $solicitacaoAtendimento = new \Model\SolicitacaoAtendimento();
        
        if(array_key_exists("idSolicitacaoAtendimento",$linha))
            $solicitacaoAtendimento->setIdSolicitacaoAtendimento($linha["idSolicitacaoAtendimento"]);
        if(array_key_exists("dataAbertura",$linha))
            $solicitacaoAtendimento->setDataAbertura(new \DateTime($linha["dataAbertura"],new \DateTimeZone("America/Sao_Paulo")));
        if(array_key_exists("idNit",$linha))
            $solicitacaoAtendimento->setIdNit($linha["idNit"]);
        if(array_key_exists("descricaoProblema",$linha))
            $solicitacaoAtendimento->setDescricaoProblema($linha["descricaoProblema"]);
        if(array_key_exists("idEscola",$linha))
            $solicitacaoAtendimento->setIdEscola($linha["idEscola"]);
        if(array_key_exists("idDonoAlternativo",$linha))
            $solicitacaoAtendimento->setIdDonoAlternativo($linha["idDonoAlternativo"]);
        if(array_key_exists("nomeEntregador",$linha))
            $solicitacaoAtendimento->setNomeEntregador($linha["nomeEntregador"]);

        return $solicitacaoAtendimento;
    }

    public function listarSolicitacoesLivres()
    {
        $consulta="select SolicitacaoAtendimento.* from solicitacaoatendimento left join Atendimento on solicitacaoatendimento.idSolicitacaoAtendimento=Atendimento.idSolicitacaoAtendimento 
                   where Atendimento.idTecnico is null;";
        $comando=$this->conexao->prepare($consulta);
        $lista=array();
        
        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha = $comando->fetch(\PDO::FETCH_ASSOC))
                    $lista[]=$this->fillObject($linha);
            }
        }
        else    
            throw new \RuntimeException("listarSolicitacoesLivres - não foi possível consultar: ");
        
        return $lista;
    }

    public function qtdSolicitacaoLivre()
    {
        $consulta="select count(SolicitacaoAtendimento.idSolicitacaoAtendimento) as qtdSolicitacao from solicitacaoatendimento left join atendimento
                   on solicitacaoatendimento.idSolicitacaoAtendimento=atendimento.idSolicitacaoAtendimento
                   where atendimento.idTecnico is null";
        $quantidade = 0;
        $comando=$this->conexao->prepare($consulta);

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                $linha = $comando->fetch(\PDO::FETCH_ASSOC);
                $quantidade= $linha["qtdSolicitacao"];
            }
        }
        else    
            throw new \RuntimeException("qtdSolicitacaoLivre: Falha ao consultar quantidade livre ".$comando->errorInfo()[2]);

        return $quantidade;
    }
    
    public function adicionar(\Model\SolicitacaoAtendimento $solicitacao)
    {
        $insere="insert into solicitacaoatendimento values(0,:dataabertura,:idnit,:descricaoproblema,
                                                             :idescola,:iddonoalternativo,:nomeentregador)";
        $comando=$this->conexao->prepare($insere);
        $comando->bindValue(":dataabertura",$solicitacao->getDataAbertura()->format("Y-m-d"),\PDO::PARAM_STR);
        $comando->bindValue(":idnit",$solicitacao->getIdNit(),\PDO::PARAM_INT);
        $comando->bindValue(":descricaoproblema",$solicitacao->getDescricaoProblema(),\PDO::PARAM_STR);
        $comando->bindValue(":idescola",$solicitacao->getIdEscola(),\PDO::PARAM_INT);
        $comando->bindValue(":iddonoalternativo",$solicitacao->getIdDonoAlternativo(),\PDO::PARAM_INT);
        $comando->bindValue(":nomeentregador",$solicitacao->getNomeEntregador(),\PDO::PARAM_STR);

        if(!$comando->execute())
            throw new \RuntimeException("Falha ao executar comando no banco de dados ".$comando->errorInfo()[2]);
        
        return true; //execute() retorna true em caso de sucesso e false em caso de erro
    }

    public function remover($idsolicitacao)
    {
        $remover="delete from solicitacaoatendimento where iSolicitacaoAtendimento=:idsolicitacao";
        $comando=$this->conexao->prepare($remover);
        
        if(!$comando->execute())
            throw new \RuntimeException("Falha ao executar comando no banco de dados ".$comando->errorInfo()[2]);
        
        return true;
    }

    public function buscar($idescola, $idnit,\DateTime $dataabertura=null)
    {
        $busca = "select idSolicitacaoAtendimento, dataAbertura, escola.nome as escola, donoalternativo.nome as donoalternativo,
                         solicitacaoatendimento.idEscola as idEscola, solicitacaoatendimento.idDonoAlternativo as idDonoAlternativo 
                         from solicitacaoatendimento
                         left join escola on solicitacaoatendimento.idEscola = escola.idEscola
                         left join donoalternativo on solicitacaoatendimento.idDonoAlternativo=solicitacaoatendimento.idDonoAlternativo
                         where 1=1";
        $listaResultado=array();      
        $buscaatendimento=null;  

        if($idescola != null)
            $busca.=" and solicitacaoatendimento.idEscola=:idescola";
        if($idnit != null)
            $busca.=" and solicitacaoatendimento.idnit=:idnit";
        if($dataabertura != null)
            $busca.=" and solicitacaoatendimento.dataAbertura=:dataabertura";

        $comando = $this->conexao->prepare($busca);

        if($idescola != null)
            $comando->bindValue(":idescola",$idescola,\PDO::PARAM_INT);
        if($idnit != null)
            $comando->bindValue(":idnit",$idnit,\PDO::PARAM_STR);
        if($dataabertura != null)
            $comando->bindValue(":dataabertura",$dataabertura->format("Y-m-d"),\PDO::PARAM_STR);
        
        if($comando->execute())
        {
            if($comando->rowCount())
            {
                /*while($linha = $comando->fetch(\PDO::FETCH_ASSOC))
                    $listaResultado[]=$this->fillObject($linha);*/
                while($linha = $comando->fetch(\PDO::FETCH_ASSOC))
                {
                    $buscaatendimento=new \Model\BuscaSolicitacaoAtendimento();
                    $buscaatendimento->setIdSolicitacaoAtendimento($linha["idSolicitacaoAtendimento"]);
                    $buscaatendimento->setEscola($linha["escola"]);
                    $buscaatendimento->setDonoAlternativo($linha["donoalternativo"]);
                    $buscaatendimento->setDataAbertura(new \DateTime($linha["dataAbertura"],new \DateTimeZone("America/Sao_Paulo")));
                    $listaResultado[]=$buscaatendimento;
                }
            }
        }
        else    
            throw new \RuntimeException("Buscando solicitaçãoes: Falha ao enviar comando ao banco de dados - ".$comando->errorInfo()[2]);
        
        return $listaResultado;
    }

    public function retornaUnico($idsolicitacao)
    {
        $consulta = "select * from solicitacaoatendimento where idSolicitacaoAtendimento=:idsolicitacao";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":idsolicitacao",$idsolicitacao,\PDO::PARAM_INT);
        $solicitacaoAtendimento = null;
        
        if($comando->execute())
        {
            if($comando->rowCount())
            {
                $linha=$comando->fetch(\PDO::FETCH_ASSOC);
                $solicitacaoAtendimento=$this->fillObject($linha);
            }
        }
        else
            throw new \RuntimeException("retornoUnico: Falha na consulta ao banco de dados: ".$comando->errorInfo()[2]);
        
        return $solicitacaoAtendimento;
    }

    public function editar(\Model\SolicitacaoAtendimento $solicitacao)    
    {
        $atualizar = "update solicitacaoatendimento set dataAbertura=:dataabertura,idNit=:idnit,descricaoProblema=:descricaoproblema,
                                                        idEscola=:idescola,idDonoAlternativo=:iddonoalternativo,nomeEntregador=:nomeentregador
                                                        where idSolicitacaoAtendimento=:idsolicitacao";
        $comando = $this->conexao->prepare($atualizar);
        $comando->bindValue(":dataabertura",$solicitacao->getDataAbertura()->format("Y-m-d"),\PDO::PARAM_STR);
        $comando->bindValue(":idnit",$solicitacao->getIdNit(),\PDO::PARAM_STR);
        $comando->bindValue(":descricaoproblema",$solicitacao->getDescricaoProblema(),\PDO::PARAM_STR);
        $comando->bindValue(":idescola",$solicitacao->getIdEscola(),\PDO::PARAM_INT);
        $comando->bindValue(":iddonoalternativo",/*$solicitacao->getIdDonoAlternativo()*/null,\PDO::PARAM_INT);
        $comando->bindValue(":nomeentregador",$solicitacao->getNomeEntregador(),\PDO::PARAM_STR);
        $comando->bindValue(":idsolicitacao",$solicitacao->getIdSolicitacaoAtendimento(),\PDO::PARAM_INT);

        if(!$comando->execute())
            throw new \RuntimeException("editar: Falha ao alterar no banco de dados: ".$comando->errorInfo()[2]);
        
        return true;
    }

}

?>