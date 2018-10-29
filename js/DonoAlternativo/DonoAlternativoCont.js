var DonoAlternativoController = {
    BuscarDono: function(parametros,fxsucesso,fxerro) {
        if(parametros.dono == null)
        {
            if(window.console)
                console.log(parametros);
            throw new Error("BuscarDono: Ausência de parâmetros para chamar controlador");
        }

        $.ajax({
            type:"post",
            url: "Controller/DonoAlternativo/DonoAlternativoController.php",
            data: {"acao":"ProcurarDono", "dono": parametros.dono},
            dataType: "json",
            success: function(retorno) {
                fxsucesso(retorno);
            },
            error: function(req,erro,msg) {
                fxerro(req,erro,msg);
            }
        });
    }
};