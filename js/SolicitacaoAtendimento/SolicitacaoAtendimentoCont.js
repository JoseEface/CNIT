var SolicitacaoAtendimentoController = {
    AdicionaSolicitacao: function(parametros, fxsucesso,fxerro) {
        if(parametros.dataabertura == null ||
           parametros.idnit == null || parametros.descricaoproblema == null ||
           parametros.nomeentregador == null || (parametros.idescola == null && parametros.iddonoalternativo == null))
            throw new Error("Ausência de parâmetros para o controlador - AdicionaSolicitação");            

        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            type: "post",
            data: {"acao":"AdicionarSolicitacao",
                   "idsolicitacao": parametros.idsolicitacao,"dataabertura": parametros.dataabertura,
                   "idnit": parametros.idnit, "descricaoproblema":parametros.descricaoproblema,
                   "nomeentregador": parametros.nomeentregador, "idescola": parametros.idescola,
                   "iddonoalternativo": parametros.iddonoalternativo
            },
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    BuscarSolicitacao: function(parametros,fxsucesso,fxerro) {
        if(parametros.escola == null && parametros.dataabertura == null  && parametros.idnit == null)
            throw new Error("Ausência de parâemtros para o controlador - BuscaSolicitacao");
        
        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",                
            type: "post",
            data: {"acao":"BuscarSolicitacao",
                   "escola": parametros.escola, "dataabertura" : parametros.dataabertura,
                   "idnit": parametros.idnit
            },
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    RemoverSolicitacao: function(parametros,fxsucesso,fxerro)
    {
        if(parametros.idsolicitacao == null)
            throw Error("Ausência de id da solicitação");
        
        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            type: "post",
            data: {"acao":"RemoverSolicitacao",
                   "idsolicitacao":parametros.idsolicitacao
            },
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });        
    },
    CarregarSolicitacao: function(parametros,fxsucesso,fxerro)
    {
        if(parametros.idsolicitacao == null)
            throw new Error("Auesência de parâmetros: idsolicitação");
        
        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            type: "post",
            data: {"acao":"CarregarSolicitacao", "idsolicitacao":parametros.idsolicitacao},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    EditarSolicitacao: function(parametros,fxsucesso,fxerro)
    {
        if(parametros.idsolicitacao == null || parametros.dataAbertura == null ||
           parametros.idnit == null || parametros.descricaoproblema == null &&
           (parametros.idescola == null || parametros.iddonoalternativo == null) )
           throw new Error("Ausência de parâmetros");
        
        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            type: "post",
            data: {"acao":"EditarSolicitacao",
                    "idsolicitacao":parametros.idsolicitacao, "dataabertura":parametros.dataAbertura,
                    "idnit":parametros.idnit,"descricaoproblema":parametros.descricaoproblema,
                    "idescola":parametros.idescola,"iddonoalternativo":parametros.iddonoalternativo,
                    "nomeentregador":parametros.nomeentregador
            },
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });

    }
};