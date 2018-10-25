var InicialView = {    
    InicieComponentesGlobal: function() {

        $(document).ready(function(){

            InicialController.CarregarPerfil(                
                function(retorno) {
                    /*if(window.console)
                        console.log(retorno);*/                   
                    if(retorno.sucesso) {
                        $("#nomeUsuario").html(retorno.dados.login);
                    }
                    else
                        alert("Ocorreu um erro ao atualizar os dados no servidor");
                },
                function(req,erro,msg) {
                    alert("Falha na requisição ao servidor.");
                    if(window.console) {
                        console.log(req); console.log(msg); console.log(erro);
                    }
                }
            );

                
            $("#menuSair, #mnpopSair").click(function(){
                $.ajax({
                    type: "post",
                    url: "Controller/Acesso/AcessoController.php",
                    data: {"acao": "logout"},
                    dataType: "json",
                    success: function(dados) {
                        location.href=".";
                    },
                    error: function (req,erro,msg) {
                        console.log(req);
                        console.log(erro);
                        console.log(msg);
                    }
                });
            });            

        });

    }, 
    InicieComponentes: function() {
        $(document).ready(function(){           

            $("#menuInicial").addClass("extraActive");

        });
    }
}