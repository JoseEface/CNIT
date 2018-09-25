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

    $("#novaDataInicio").datepicker({changeYear: true});
    $("#novaDataFinalizacao").datepicker({changeYear: true});
    $("#editarDataInicio").datepicker({changeYear: true});
    $("#editarDataFinalizacao").datepicker({changeYear: true});


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
        dataType: "json",
        success: function(retorno) {
            //console.log(retorno);
            if(retorno.sucesso) {
                for(x=0;x<retorno.dados.length;x++)
                {
                    $("#buscaTecnico").append("<option value='"+retorno.dados[x].idTecnico+"'>"+retorno.dados[x].nome+"</option>");
                    $("#novoTecnico").append("<option value='"+retorno.dados[x].idTecnico+"'>"+retorno.dados[x].nome+"</option>");
                }
            }
            else {
                alert("Falha ao preencher select list de tecnicos "+retorno.mensagem)
            }
        },
        error: function(req,erro,msg) {
            console.log(req); console.log(erro);
            console.log(msg);
        }
    });

    $.ajax({
        type: "post",
        url: "Controller/LocalNaDe/LocalNaDeController.php",
        data: {"acao":"getLista"},
        dataType: "json",
        success: function(retorno) {
            //console.log(retorno);
            if(retorno.sucesso) {
                for(x=0;x<retorno.dados.length;x++)
                {
                    $("#novoLocalDE").append("<option value='"+retorno.dados[x].idLocalNaDe+"'>"+retorno.dados[x].local+"</option>");
                    $("#editarLocalDE").append("<option value='"+retorno.dados[x].idLocalNaDe+"'>"+retorno.dados[x].local+"</option>");
                }
            }
            else {
                alert("Falha ao preencher box de Locais na de "+retorno.mensagem)
            }
        },
        error: function(req,erro,msg) {
            alert("Falha na solicitação ao servidor");
            console.log(req); console.log(erro); console.log(msg);
        }

    });

    $.ajax({
        type: "post",
        url: "Controller/Situacao/SituacaoController.php",
        data: {"acao":"getLista"},
        dataType: "json",
        success: function(retorno) {            
            if(retorno.sucesso) {
                for(x=0;x<retorno.dados.length;x++)   
                {
                    $("#buscaSituacao").append("<option value='"+retorno.dados[x].idSituacao+"'>"+retorno.dados[x].situacao+"</option>");
                    $("#novaSituacao").append("<option value='"+retorno.dados[x].idSituacao+"'>"+retorno.dados[x].situacao+"</option>");
                    $("#editarSituacao").append("<option value='"+retorno.dados[x].idSituacao+"'>"+retorno.dados[x].situacao+"</option>");
                }
            }
            else {
                alert("Falha ao preencher box de Situações "+retorno.mensagem);
            }
        },
        error: function(req,erro,msg) {
            alert("Falha na solicitação ao servidor");
            console.log(req); console.log(erro); console.log(msg);
        }   
    });

    $.ajax({
        type: "post",
        url: "Controller/SolicitacaoAtendimento/SolicitacaoAtendimentoController.php",
        data: {"acao":"listarSemAtendimento"},
        dataType: "json",
        success: function(retorno) {
            console.log(retorno);
            if(retorno.sucesso) {
                for(x=0;x<retorno.dados.length;x++)
                    $("#novoSolicitacaoAtendimento").append("<option value='"+retorno.dados[x].idSolicitacaoAtendimento+"'>"+(new Date(retorno.dados[x].dataAbertura.date)).toLocaleDateString()+" - "+retorno.dados[x].idNit+", "+retorno.dados[x].descricaoProblema+"</option>");
            }
            else {
                alert("Ocorreu um erro ao consultar o servidor: "+retorno.mensagem);                
            }
        },
        error: function(req, erro, msg) {

        }
    });

    $("#btnProcurar").click(function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "Controller/Atendimento/AtendimentoController.php",
            data: { "idtecnico" : $("#buscaTecnico").val(), "idnit": $("#buscaIdNit").val(), "idsituacao" : $("#buscaSituacao").val()  },
            dataType: "json",
            success: function(retorno) {
                if(retorno.sucesso) {
                    for(x=0;x<retorno.length;x++)
                    {
                        tabela.clear().draw();
                        for(x=0;x<retorno.dados.length;x++)
                        {
                            /**TODO**/
                            /**PREENCHER DATATABLE**/                            
                        }
                    }
                }
                else {
                    alert("Não foi possível consultar informações: "+retorno.mensagem);
                }
            },
            error: function(req,erro,msg) {
                alert("Falha na solicitação");
                console.log(req); console.log(erro); console.log(msg);
            }
        });
    });

});

</script>