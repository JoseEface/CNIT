
function criarValidador(idjqFormulario, regras)
{
    var validador=$(idjqFormulario).validate({
        rules: regras,
        errorPlacement: function(error,elemento) {
            /*console.log(error); console.log(elemento);
            console.log("#v"+$(elemento).attr("id")); console.log(error.text());*/
            $("#v"+$(elemento).attr("id")).html(error.text());
            /*console.log("Deu erro");
            console.log("#v"+$(elemento).attr("id"));*/
        },
        success: function(label, element) {
            //console.log("Está ok");
            $("#v"+$(element).attr("id")).html("");
        }
    });

    return validador;
}

function criaDataTable(idjqTabela)
{
    var tabela=$(idjqTabela).DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
        }
    });

    return tabela;
}