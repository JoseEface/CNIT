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
