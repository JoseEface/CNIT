var MinhaContaController= {
    QtdMinhasSolicitacoes: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/MinhaConta/MinhaContaController.php",
            data: {"acao":"QtdMinhasSolicitacoes"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    AlterarConta: function(parametros, fxsucesso, fxerro) {
        if(parametros.nome == null || parametros.login == null || parametros.senhaAtual == null ||
           parametros.senhaNova == null || parametros.senhaConfirma == null) {
            if(window.console)
                 console.log(parametros);            
            throw new Error("MinhaContaController: Ausência de parâmetros para chamar o controlador");

        }
        $.ajax({
            type: "post",
            url: "Controller/MinhaConta/MinhaContaController.php",
            data: {"acao":"AlterarPerfil","nome":parametros.nome,"login":parametros.login,
                   "senhaAtual":parametros.senhaAtual,"senhaNova":parametros.senhaNova,
                   "senhaConfirma":parametros.senhaConfirma
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
    ConfereSenha: function(parametros,fxsucesso,fxerro,assincrono)
    {
        if(parametros.senha == null)
            throw new Error("AlterarConta: Ausência de parâmetros para chamar o controlador.");
        
        $.ajax({
            type: "post",
            url: "Controller/MinhaConta/MinhaContaController.php",
            data: {"acao":"SenhaConfere","senha":parametros.senha},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            },
            async: assincrono
        });
    },
    LoginExiste: function(parametros,fxsucesso,fxerro,assincrono)
    {
        if(parametros.login == null)
        {
            if(window.console)
                console.log(parametros);
            throw new Error("LoginExiste: Ausência de parâmetros para o controlador");
        }

        if(typeof assincrono == "undefined")
            assincrono=true;

        $.ajax({
            type: "post",
            url: "Controller/MinhaConta/MinhaContaController.php",
            data: {"acao":"LoginExiste", "login":parametros.login},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            },
            async: assincrono
        });
    }    
}