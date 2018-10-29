var InicialController = {
    CarregarPerfil: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/Inicial/InicialController.php",
            data: {"acao":"CarregarPerfil"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    },
    FazerLogout: function(fxsucesso,fxerro) {
        $.ajax({
            type: "post",
            url: "Controller/Acesso/AcessoController.php",
            data: {"acao": "logout"},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function (req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    }
};