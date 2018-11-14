<?php

namespace Model\DAO;

include_once dirname(__FILE__)."/../SolicitacoesDiaMes.class.php";

class EstatisticasDAO
{
    private $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }   

    /*Onde numeromes 1-12*/
    public function QtdSolicitacoesDiaMes($numeromes)
    {
        $consulta = "select dataAbertura as Data,count(idSolicitacaoAtendimento) as Quantidade from solicitacaoatendimento    
                     where month(dataAbertura)=:numeromes group by dataAbertura";
        $comando = $this->conexao->prepare($consulta);
        $comando->bindValue(":numeromes",$numeromes,\PDO::PARAM_INT);
        $listaEstatistica = array();

        if($comando->execute())
        {
            if($comando->rowCount())
            {
                while($linha = $comando->fetch(\PDO::FETCH_ASSOC))
                {
                    $novosdiames = new \Model\SolicitacoesDiaMes();
                    $novosdiames->setDia(new \DateTime($linha["Data"],new \DateTimeZone("America/Sao_Paulo")));
                    $novosdiames->setQuantidade($linha["Quantidade"]);
                    $listaEstatistica[]=$novosdiames;                    
                }
            }            
        }
        else
            throw new \RuntimeException("EstatisticaDAO: Erro ao executar operação: ".$comando->errorInfo()[2]);
        
        return $listaEstatistica;
    }
}

?>