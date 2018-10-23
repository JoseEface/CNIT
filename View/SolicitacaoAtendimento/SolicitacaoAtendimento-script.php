<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"> </script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_pt_BR.min.js"></script>


<script src="js/datepicker-BR.js"> </script>
<script src="js/PluginUtil.js"> </script>
<script type="text/javascript" src="js/SolicitacaoAtendimento/SolicitacaoAtendimentoView.js"> </script>
<script type="text/javascript" src="js/Escola/EscolaCont.js"> </script>


<script>
    SolicitacaoAtendimentoView.InicieComponentes();
/*
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

        $("#menuSolicitacao").addClass("extraActive");

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
    */
/*
  $(document).ready(function(){
    $('.modal').on('show.bs.modal', function () {
      if ($(document).height() > $(window).height()) {
        // no-scroll
        $('body').addClass("modal-open-noscroll");
      }
      else { 
        $('body').removeClass("modal-open-noscroll");
      }
    });
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    });
  });
*/
</script>
