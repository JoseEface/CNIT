var EstatisticaController = {
    SolicitacoesDiaMes: function(parametros, fxsucesso,fxerro) {
        if(parametros.mes == null)
            throw new Error("EstatisticaControlle: Ausência de parâmetros para chamar o controlador");

        $.ajax({
            type: "post",
            url: "Controller/Estatistica/EstatisticaController.php",
            dataType: "json",
            data: {"acao":"SolicitacoesDiaMes","mes":((new Date()).getMonth()+1)},
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    }
};