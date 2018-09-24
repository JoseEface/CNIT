<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"> </script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="js/datepicker-BR.js"> </script>


<script>

var tabela=null;

$(document).ready(function(){
    
    tabela=$("#tblAtendimentos").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
    });

    $("#menuAtendimento").addClass("extraActive");

    $("#novaDataInicio").datepicker();
    $("#novaDataFinalizacao").datepicker();
    $("#editarDataInicio").datepicker();
    $("#editarDataFinalizacao").datepicker();


    $("#novaDataInicio").click(function(){
        $("#novaDataInicio").datepicker("setDate",null);
    });

    $("#novaDataFinalizacao").click(function(){
        $("#novaDataFinalizacao").datepicker("setDate",null);
    });
    $("#editarDataFinalizacao").click(function(){
        $("#editarDataFinalizacao").datepicker("setDate",null);
    });

    $.ajax({
        type: "post",
        url: "Controller/Tecnico/TecnicoController.php",
        data: {"acao":"getLista"},
        success: function(retorno) {
            console.log(retorno);
            if(retorno.sucesso) {
                alert(retorno.dados[0].nome);
            }
            else {

            }
        },
        error: function(req,erro,msg) {
            console.log(req); console.log(erro);
            console.log(msg);
        }
    });

});

</script>