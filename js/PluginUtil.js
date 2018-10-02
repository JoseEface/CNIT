
function criarValidador(idjqFormulario, regras)
{
    var validador=$(idjqFormulario).validate({
        rules: regras,
        errorPlacement: function(error,elemento) {
            $("#v"+$(elemento).attr("id")).html(error.text());
        },
        success: function(label, element) {
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