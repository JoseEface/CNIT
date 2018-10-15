<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../SolicitacaoAtendimento.class.php";

class SolicitacaoDAO 
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
            $solicitacaoAtendimento->setIdSolicitacaoAtendimento();
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
        $consulta="select SolicitacaoAtendimento.* from SolicitacaoAtendimento left join Atendimento
                  on SolicitacaoAtendimento.idSolicitacaoAtendimento=Atendimento.idSolicitacaoAtendimento where Atendimento.idTecnico=null";
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
        
        return $lista;
    }
}

?>