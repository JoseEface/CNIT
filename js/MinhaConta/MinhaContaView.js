var MinhaContaView = {
    validadorMinhaConta: null,
    InicieComponentes: function() {        

        MinhaContaView.validadorMinhaConta=criarValidador("#formAlterar",
        {
            nomeConta: {
                required: true
            },
            loginConta: {
                required: true
            },
            senhaConta: {
                required: true
            },
            senhaAlterarConta: {
                required: true
            },
            senhaConfirmaConta: {
                equalTo: "#senhaAlterarConta"
            }
        });

        $("#btnAlterar").click(function(e){            
            if($("#formAlterar").valid())
            {

            }
            else
            {
                alert("Ocorreram erros de validação");
            }
        });

    }
};