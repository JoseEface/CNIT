<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../Atendimento.class.php";

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
            $atendimento->setDataFinalizado(is_null($linha["dataFinalizadp"])? null : (new \DateTime($linha["dataFinalizado"],new \DateTimeZone("America/Sao_Paulo"))) );
        if(array_key_exists("dataIncio",$linha))
            $atendimento->setDataInicio(new \DateTime($linha["dataInicio"],new \DateTimeZone("America/Sao_Paulo")) );            
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

        return $lista;
    }

    public function retornaUnico($idTecnico, $idSolicitacaoAtendimento)
    {
        $consulta= "select * from Atendimento where idTecnico=:idTecnico and idSolicitacaoAtendimento=:idSolicitacao";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":idTecnico",$idTecnico);
        $comando->bindValue(":idSolicitacao",$idSolicitacaoAtendimento);
        $linha=null;
        $atendimento;

        if($comando->execute())
        {
            if($comando->rowCount())
            {                
                $linha = $comando->fetch(\PDO::FETCH_ASSOC));
                $atendimento=$this->fillObject($linha);
            }
        }

    }


}


?>