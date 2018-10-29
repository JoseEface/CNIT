var InicialView = {    
    DadosUsuario: null,    
    InicieComponentesGlobal: function() {

        $(document).ready(function(){

            InicialController.CarregarPerfil(                
                function(retorno) {
                    /*if(window.console)
                        console.log(retorno);*/                   
                    if(retorno.sucesso) {
                        $("#indLoginUsuario").html(retorno.dados.login);
                        $("#nomeUsuario").html(retorno.dados.nome);
                    }
                    else {
                        alert("Ocorreu um erro ao atualizar os dados no servidor");
                        if(window.console)
                            console.log(retorno);
                    }
                },
                function(req,erro,msg) {
                    alert("Falha na requisição ao servidor.");
                    if(window.console) {
                        console.log(req); console.log(msg); console.log(erro);
                    }
                }
            );

                
            $("#menuSair, #mnpopSair").click(function(){
                InicialController.FazerLogout(
                    function(retorno) {
                        if(retorno.sucesso) {
                            location.href=".";
                        }
                        else
                        {
                            alert("Falha ao efetuar logout");
                            if(window.console)
                                console.log(retorno);
                        }
                    },
                    function(req,erro,msg) {
                        alert("Falha na requisição ao servidor");
                        if(window.console)
                        {
                            console.log(req); console.log(erro);
                            console.log(msg);
                        }
                    }
                );
            });            

        });

    }, 
    InicieComponentes: function() {
        $(document).ready(function(){           

            $("#menuInicial").addClass("extraActive");
            
            $("#ano").html( (new Date()).getFullYear() );

            SolicitacaoAtendimentoController.QtdSolicitacoesLivres(
                function(retorno) {
                    if(retorno.sucesso)
                        $("#qtdDisponivel").html(""+retorno.dados);
                    else {
                        alert("Falha ao buscar solicitações livres");
                    }
                },
                function(req,erro,msg) {
                    alert("Falha na solicitação ao servidor");
                    if(window.console)
                    {
                        console.log(req); console.log(erro);
                        console.log(msg);
                    }
                }
            );

            MinhaContaController.QtdMinhasSolicitacoes(
                function(retorno) {
                    if(retorno.sucesso) {
                        $("#qtdAtendidas").html(retorno.dados);
                    }
                    else {
                        if(window.console) {
                            console.log(retorno);
                        }
                        alert("Falha ao consultar servidor");
                    }
                },
                function(req,erro,msg) {
                    alert("Falha na solicitação ao servidor !");
                    if(window.console) {
                        console.log(req); console.log(erro); console.log(msg);
                    }
                }
            );

        });
    }
}