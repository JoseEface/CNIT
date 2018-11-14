var SolicitacaoAtendimentoController = {
    ProcurarDono: function(parametros,fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"ProcurarDono"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    BuscaSolicitacoesLivres: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"BuscaSolicitacoesLivres"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    QtdSolicitacoesLivres: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"QtdSolicitacaoLivre"},
            success: function(retorno) 
            {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    AdicionaSolicitacao: function(parametros, fxsucesso,fxerro) {
        if(parametros.dataabertura == null ||
           parametros.idnit == null || parametros.descricaoproblema == null ||
           parametros.nomeentregador == null || (parametros.idescola == null && parametros.iddonoalternativo == null))
            throw new Error("AdicionaSolicitacao: Ausência de parâmetros para o controlador - AdicionaSolicitação");            
        if(parametros.iddonoalternativo != "" && parametros.idescola != "")
            throw new Error("AdicionaSolicitacao: Você pode definir ou um id para a escola ou um id para o dono");

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
        if(parametros.idsolicitacao == null || parametros.dataabertura == null ||
           parametros.idnit == null || parametros.descricaoproblema == null &&
           (parametros.idescola == null && parametros.iddonoalternativo == null) )
           throw new Error("Ausência de parâmetros");

        if(parametros.idescola != "" && parametros.iddonoalternativo != "")
            throw new Error("Defina ou um dono em outro local ou um dono em uma escola - não podem haver dois donos");
        
        $.ajax({
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            type: "post",
            data: {"acao":"EditarSolicitacao",
                    "idsolicitacao":parametros.idsolicitacao, "dataabertura":parametros.dataabertura,
                    "idnit":parametros.idnit,"descricaoproblema":parametros.descricaoproblema,
                    "idescola":parametros.idescola,"iddonoalternativo":parametros.iddonoalternativo,
                    "nomeentregador":parametros.nomeentregador
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
    SolicitacoesLivres: function(fxsucesso,fxerro) 
    {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"listarSemAtendimento"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    ListarTodasSolicitacoes: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
            data: {"acao":"ListarTodas"},
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    }
};