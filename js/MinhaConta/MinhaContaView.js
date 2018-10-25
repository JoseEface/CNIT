var MinhaContaView = {
    validadorMinhaConta: null,
    InicieComponentes: function() {        

        $.validator.addMethod("senhaconfere",function(valor,elemento){
            var temUsuario=false;

            if($("#senhaConta").val() == "")
                return true;

            MinhaContaController.ConfereSenha({senha: $("#senhaConta").val()},
                function(retorno) {
                    if(retorno.sucesso)
                        temUsuario=retorno.dados;
                    else
                        temUsuario=false;
                },
                function(req,erro,msg) {
                    if(window.console) {
                        console.log("Falha ao solicitar informações ao servidor");
                        console.log(req); console.log(erro); console.log(msg);
                    }
                    temUsuario=false;
                },
            false);

            return temUsuario;
        },"Senha digitada não confere");

        MinhaContaView.validadorMinhaConta=criarValidador("#formAlterar",
        {
            nomeConta: {
                required: true
            },
            loginConta: {
                required: true
            },
            senhaConta: {
                /*required: true,*/
                senhaconfere: true
            },
            senhaAlterarConta: {
                /*required: true*/
            },
            senhaConfirmaConta: {
                equalTo: "#senhaAlterarConta"
            }
        });

        $("#btnAlterar").click(function(e){            
            if($("#formAlterar").valid())
            {
                MinhaContaController.AlterarConta({
                    nome: $("#nomeConta").val(), login: $("#loginConta").val(),
                    senha: $("#senhaConta").val(), senhaNova: $("#senhaNova").val(),
                    senhaConfirma: $("#senhaConfirma").val()
                },function(retorno) {
                    console.log(retorno);
                    if(dados.sucesso)
                    {
                        alert("Perfil atualizado com sucesso !");
                        location.reload();    
                    }
                    else 
                        alert("FALHA ao atualizar perfil.");                         
                },function(req,erro,msg) {
                    alert("Falha ao requisitar ao servidor");
                    console.log(req); console.log(erro); console.log(msg);
                });
            }
            else            
                alert("Ocorreram erros de validação");            
        });

        InicialController.CarregarPerfil(
            function(retorno) 
            {
                if(retorno.sucesso) {
                    $("#nomeConta").val(retorno.dados.nome);
                    $("#loginConta").val(retorno.dados.login);                    
                }
                else {
                    alert("Falha ao retornar dados do servidor.");
                    if(window.console)
                        console.log(retorno);
                }
            },
            function(req,erro,msg) 
            {
                alert("Falha na solicitação ao servidor.");
                if(window.console) {
                    console.log(req); console.log(erro); console.log(msg);
                }
            }
        );

    }
};