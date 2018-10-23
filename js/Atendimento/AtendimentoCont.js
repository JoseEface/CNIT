var AtendimentoController = {
    ListaTecnicos: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/Tecnico/TecnicoController.php",
            data: {"acao":"getLista"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });    
    },
    ListaLocalNaDe: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/LocalNaDe/LocalNaDeController.php",
            data: {"acao":"getLista"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
    
        });    
    },
    ListaSituacao: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/Situacao/SituacaoController.php",
            data: {"acao":"getLista"},
            dataType: "json",
            success: function(retorno) {            
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }   
        });    
    },
    AdicionarAtendimento: function(parametros,fxsucesso,fxerro) {
        if(parametros.novoTecnico == null || parametros.novaSolicitacaoAtendimento == null ||
           parametros.novoLocalDE == null || parametros.novaSituacao == null ||
           parametros.novaDataInicio == null || parametros.novaDataFinalizacao == null ||
           parametros.novaDescricaoSolucao == null) {               
                console.log(parametros);
                throw new Error("AdicionarAtendimento: ausência de parâmetros");
           }

        $.ajax({
            type: "post",
            url: "Controller/Atendimento/AtendimentoController.php",
            data: {"acao" : "adicionar", "novoTecnico": parametros.novoTecnico, "novaSolicitacaoAtendimento": parametros.novaSolicitacaoAtendimento, 
                   "novoLocalDE": parametros.novoLocalDE,"novaSituacao": parametros.novaSituacao, "novaDataInicio": parametros.novaDataInicio, 
                   "novaDataFinalizacao": parametros.novaDataFinalizacao, "novaDescricaoSolucao":parametros.novaDescricaoSolucao },
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    ListaSolicitacaoSemAtendimento: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"listarSemAtendimento"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req, erro, msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    BuscaAtendimento: function(parametros,fxsucesso,fxerro) {
        if(parametros.idtecnico == null || parametros.idnit == null || parametros.idsituacao == null) {
            console.log(parametros); 
            throw new Error("Ausência de argumentos para BuscaAtendimento");
        }
        $.ajax({
            type: "post", 
            url: "Controller/Atendimento/AtendimentoController.php",
            data: { "acao" : "buscaAtendimento", "idtecnico" : parametros.idtecnico, "idnit": parametros.idnit, "idsituacao" : parametros.idsituacao },
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    QuantidadeSolicitacaoLivre: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/Atendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"qtdSolicitacaoAtendimento"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    CarregarAtendimento: function(parametros,fxsucesso,fxerro) {
        if(parametros.idtecnico == null || parametros.idsolicitacao == null)
            throw new Error("CarregarAtendimento: idtecnico não definida");        
        $.ajax({
            type: "post",
            url: "Controller/Atendimento/AtendimentoController.php",
            data: {"acao":"carregarAtendimento","idtecnico": parametros.idtecnico, "idsolicitacao": parametros.idsolicitacao},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        }); 
    },
    AlterarAtendimento: function(parametros,fxsucesso,fxerro) {        
        if(parametros.localde == null || parametros.situacao == null ||
           parametros.datainicio == null || parametros.datafim == null ||
           parametros.descricao == null || parametros.idtecnico == null ||
           parametros.idsolicitacao == null)
           throw new Error("AlterarAntendimento: Ausência de parâmetros");
        $.ajax({
            type: "post",
            url: "Controller/Atendimento/AtendimentoController.php",
            data: {"acao":"alterarAtendimento","idtecnico":parametros.idtecnico,
                   "idsolicitacao":parametros.idsolicitacao, "localde":parametros.localde,
                   "situacao":parametros.situacao,"datainicio":parametros.datainicio,
                   "datafim":parametros.datafim,"descricao":parametros.descricao},
            dataType: "json",
            success: function(retorno) {                
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {                
                fxerro(req,erro, msg);
            }
        });
        /***TODO: 
         * solicitacao ajax -> AtendimentoDAO->editar()
        */
    }
}