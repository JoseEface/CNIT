var EscolaController = {
    ListarEscolas: function(fxsucesso,fxerro)
    {
        $.ajax({
            url: "Controller/Escola/EscolaController.php",
            type: "post",
            data: {"acao":"ListarNomeEscolas"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    }
}