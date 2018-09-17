<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"> </script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="js/datepicker-BR.js"> </script>

<script>
    var addflag=false;
    var edflag=false;

    $(document).ready(function(){
        
        var tabela= $("#tblSolicitacoes").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

        $(".datepicker").datepicker();
        $(".datepicker").datepicker("setDate",new Date());

        $("#modalBuscarDono").on("hidden.bs.modal", function() {
            if(addflag)
            {
                addflag=false;            
                $("#modalAdicionar").modal();
            }
            if(edflag)
            {
                edflag=false;
                $("#modalEdicao").modal();
            }
        });

    });

    function donoSolicitado(modaldiv)
    {
        if(modaldiv == "modalAdicionar" && $("#modalAdicionar").is(":visible"))
        {
            $("#modalAdicionar").modal("hide");
            addflag=true;
        }
        if(modaldiv == "modalEdicao" && $("#modalEdicao").is(":visible"))
        {
            $("#modalEdicao").modal("hide");
            edflag=true;
        }

        $("#modalBuscarDono").modal();
    }


</script>
