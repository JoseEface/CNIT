<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Atendimento.class.php";
include_once dirname(__FILE__)."/../BuscaAtendimento.class.php";

class AtendimentoDAO
{
    private $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao=$conexao;
    }    

    public function fillObject(&$linha)
    {
        $atendimento = new \Model\Atendimento();
        if(array_key_exists("idTecnico",$linha))
            $atendimento->setIdTecnico($linha["idTecnico"]);
        if(array_key_exists("idSolicitacaoAtendimento",$linha))
            $atendimento->setIdSolicitacaoAtendimento($linha["idSolicitacaoAtendimento"]);
        if(array_key_exists("descricaoSolucao",$linha))
            $atendimento->setDescricaoSolucao($linha["descricaoSolucao"]);
        if(array_key_exists("idLocalNaDE",$linha))
            $atendimento->setIdLocalNaDe($linha["idLocalNaDE"]);
        if(array_key_exists("idSituacao",$linha))
            $atendimento->setIdSituacao($linha["idSituacao"]);
        if(array_key_exists("dataFinalizado",$linha))
            $atendimento->setDataFinalizado(is_null($linha["dataFinalizado"])? null : (new \DateTime($linha["dataFinalizado"],new \DateTimeZone("America/Sao_Paulo"))) );
        if(array_key_exists("dataInicio",$linha))
            $atendimento->setDataInicio(new \DateTime($linha["dataInicio"],new \DateTimeZone("America/Sao_Paulo")) );            
        //print_r($atendimento);
        return $atendimento;
    }

    public function listarTodos()
    {
        $consulta = "select * from Atendimento";
        $comando = $this->conexao->prepare($consulta);
        $lista=array();
        $atendimento=null;

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha=$comando->fetch(\PDO::FETCH_ASSOC))
                    $lista[]=$this->fillObject($linha);
            }
        }
        
        $comando->closeCursor();

        return $lista;
    }

    public function retornaUnico($idTecnico, $idSolicitacaoAtendimento)
    {
        $consulta= "select * from atendimento where idtecnico=1 and idsolicitacaoatendimento=1";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":idTecnico",$idTecnico);
        $comando->bindValue(":idSolicitacao",$idSolicitacaoAtendimento);
        $linha=null;
        $atendimento=null;

        if($comando->execute())
        {
            if($comando->rowCount())
            {                
                $linha = $comando->fetch(\PDO::FETCH_ASSOC);
                $atendimento=$this->fillObject($linha);
            }
        }
        else
            echo "O comando não executou";

        $comando->closeCursor();

        return $atendimento;
    }

    public function listaAtendimentoBusca($idTecnico, $idnit, $idSituacao) {
        $consulta="select atendimento.idTecnico as idTecnico, atendimento.idSolicitacaoAtendimento as idSolicitacaoAtendimento, solicitacaoatendimento.idNit as idNit, escola.nome as escolaNome, tecnico.nome as tecnicoNome, situacao.situacao as situacao 
                   from atendimento 
                   inner join solicitacaoatendimento on atendimento.idSolicitacaoAtendimento=SolicitacaoAtendimento.idSolicitacaoAtendimento
                   inner join tecnico on atendimento.idTecnico=tecnico.idTecnico 
                   inner join situacao on atendimento.idSituacao=situacao.idSituacao
                   left join escola on solicitacaoatendimento.idEscola = escola.idEscola
                   where 1=1";
        $lista=array();
        $linha=null;
        $buscaAtendimento=null;
        
        if($idTecnico != null)
            $consulta.=" and Atendimento.idTecnico=:idTecnico";
        if($idnit != null)
            $consulta.=" and idNit=:idNit";
        if($idSituacao != null)
            $consulta.=" and situacao.idSituacao=:idSituacao";
        
        $comando=$this->conexao->prepare($consulta);
        if($idTecnico != null)
            $comando->bindValue(":idTecnico",$idTecnico,\PDO::PARAM_INT);
        if($idnit != null)
            $comando->bindValue(":idNit",$idnit,\PDO::PARAM_STR);
        if($idSituacao != null)
            $comando->bindValue(":idSituacao",$idSituacao,\PDO::PARAM_INT);

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha = $comando->fetch(\PDO::FETCH_ASSOC))
                {
                    $buscaAtendimento=new \Model\BuscaAtendimento();
                    $buscaAtendimento->setIdTecnico($linha["idTecnico"]);
                    $buscaAtendimento->setIdSolicitacaoAtendimento($linha["idSolicitacaoAtendimento"]);
                    $buscaAtendimento->setIdNit($linha["idNit"]);
                    $buscaAtendimento->setEscolaNome($linha["escolaNome"]);
                    $buscaAtendimento->setTecnicoNome($linha["tecnicoNome"]);
                    $buscaAtendimento->setSituacao($linha["situacao"]);
                    $lista[]=$buscaAtendimento;
                }
            }
        }
        
        $comando->closeCursor();

        return $lista;
    }

    public function adicionar(\Model\Atendimento $novoAtendimento)
    {
        $insercao = "insert into Atendimento values(:idtecnico,:idsolicitacaoatendimento,:descricaosolucao,:idlocalnade,:idsituacao,:datafinalizado,:datainicio);";
        $comando = $this->conexao->prepare($insercao);

        $comando->bindValue(":idtecnico",$novoAtendimento->getIdTecnico(),\PDO::PARAM_INT);
        $comando->bindValue(":idsolicitacaoatendimento",$novoAtendimento->getIdSolicitacaoAtendimento(),\PDO::PARAM_INT);
        $comando->bindValue(":descricaosolucao",$novoAtendimento->getDescricaoSolucao(),\PDO::PARAM_STR);
        $comando->bindValue(":idlocalnade",$novoAtendimento->getIdLocalNaDe(),\PDO::PARAM_INT);
        $comando->bindValue(":idsituacao",$novoAtendimento->getIdSituacao(),\PDO::PARAM_INT);
        $comando->bindValue(":datafinalizado",($novoAtendimento->getDataFinalizado() == null)?null:$novoAtendimento->getDataFinalizado()->format("Y-m-d"),\PDO::PARAM_STR);
        $comando->bindValue(":datainicio",$novoAtendimento->getDataInicio()->format("Y-m-d"),\PDO::PARAM_STR);
        
        return $comando->execute();    
    }

    public function verificaAtendimentoLivre($idSolicitacaoAtendimento)
    {
        $consulta = "select count(solicitacaoatendimento.idSolicitacaoAtendimento) as qtdSolicitacao from solicitacaoatendimento 
                     inner join atendimento on solicitacaoatendimento.idSolicitacaoAtendimento=atendimento.idSolicitacaoAtendimento 
                     where solicitacaoatendimento.idSolicitacaoAtendimento=:idsolicitacao;";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":idsolicitacao",$idSolicitacaoAtendimento,\PDO::PARAM_INT);
        $quantidade=0;

        if($comando->execute())        
        {
            $linha=$comando->fetch(\PDO::FETCH_ASSOC);
            $quantidade=$linha["qtdSolicitacao"];
        }
        else
            throw new \RuntimeException("atendimentolivre-dao: falha ao consultar atendimento livre");

        $comando->closeCursor();

        return ($quantidade==0);
    }
}


?>