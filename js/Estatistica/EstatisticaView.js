var EstatisticaView = {
    InicieComponentes: function() {
        EstatisticaController.SolicitacoesDiaMes(
            {mes :((new Date()).getMonth()+1) },
            function (retorno) {
                if(retorno.sucesso) {
                    console.log(retorno);
                    alert("Valor retornado");
                }
                else {
                    if(window.console) {
                        console.log(retorno);
                    }
                    alert("FALHA: Não foi possível consultar o servidor");
                }
            },
            function (req,erro,msg) {
                if(window.console) {
                    console.log(req); console.log(erro); console.log(msg);
                }
                alert("Falha na requisição ao sevidor");
            }
        );
    }
};