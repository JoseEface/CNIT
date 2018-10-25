var MinhaContaController= {
    AlterarConta: function(parametros, fxsucesso, fxerro) {
        if(parametros.nome == null || parametros.login == null || parametros.senhaAtual == null ||
           parametros.senhaNova == null || parametros.senhaConfirma == null)
            throw new Error("MinhaContaController: Ausência de parâmetros para chamar o controlador");
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
    }
}