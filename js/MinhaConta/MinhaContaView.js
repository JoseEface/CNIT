var MinhaContaView = {
    validadorMinhaConta: null,
    loginAtual: null,
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

        $.validator.addMethod("loginexiste",function(valor,elemento){
            var naoTemLogin=false;            

            MinhaContaController.LoginExiste(
                {login: $("#loginConta").val()},
                function(retorno) {
                    if(retorno.sucesso) {
                        //console.log(retorno);
                        naoTemLogin=!retorno.dados;
                    } 
                    else {
                        if(window.console) {
                            console.log("Falha no retorno do servidor");
                            console.log(retorno);
                        }
                    }
                },
                function(req,erro,msg) 
                {
                    console.log("LoginExisteJs: Falha na solicitação ao servidor");
                    if(window.console) {
                        console.log(req); console.log(erro);console.log(msg);
                    }
                }, false);
            
            return naoTemLogin;
        },"Esse login já existe");

        MinhaContaView.validadorMinhaConta=criarValidador("#formAlterar",
        {
            nomeConta: {
                required: true
            },
            loginConta: {
                required: true,
                loginexiste: true
            },
            senhaConta: {
                /*required: true,*/
                required: function(element) {                    
                    return ($("#senhaAlterarConta").val() != "" || $("#senhaConfirmaConta").val() != "");
                },
                senhaconfere: true
            },
            senhaAlterarConta: {
                /*required: true*/
            },
            senhaConfirmaConta: {
                equalTo: "#senhaAlterarConta"
            }
        });
/*
        $("#senhaAlterarConta").change(function(){
            MinhaContaView.validadorMinhaConta.element("#senhaConta");
        });

        $("#senhaConfirmaConta").change(function(){
            MinhaContaView.validadorMinhaConta.element("#senhaConta");            
        }); */

        $("#btnAlterar").click(function(e){            
            if($("#formAlterar").valid())
            {
                MinhaContaController.AlterarConta({
                    nome: $("#nomeConta").val(), login: $("#loginConta").val(),
                    senhaAtual: $("#senhaConta").val(), senhaNova: $("#senhaAlterarConta").val(),
                    senhaConfirma: $("#senhaConfirmaConta").val()
                },function(retorno) {
                    console.log(retorno);
                    if(retorno.sucesso)
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
                    MinhaContaView.loginAtual=retorno.dados.login;                  
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