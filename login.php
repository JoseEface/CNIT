<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CNIT - Controle de consertos NIT </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
       

    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -30px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 30px;        
      }
      #footer {        

        text-align: center;        
      }

      .help-block {
          color: red;
      }


      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      
      .extraActive {
        font-weight: bold;
        background: whitesmoke;
      }

.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

.modal-backdrop {
   background-color: lightgray;
}

    </style>
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->


  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

        <div id="modalLogin" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm modal-center">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: RoyalBlue; color: white; font-weight: bold; font-size: 16px; text-align: center;">
                        <div class="modal-title">DeSJRP CNIT - Acessar</div>
                    </div>
                    <div class="modal-body">
                        
                        <form method="post" id="formularioLogin" action="">
                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" />
                                <div class="help-block" id="vusuario"></div>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" />
                                <div class="help-block" id="vsenha"></div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer" style="text-align: center;" >
                        <button type="button" class="btn btn-success" id="btnAcessar">Acessar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">

      </div>
    </div>



    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/localization/messages_pt_BR.min.js"></script>

    <script>
        $(document).ready(function(){

            $("#modalLogin").modal({backdrop: "static", keyboard: "false"});

            $("#formularioLogin").validate({
                rules: {
                    usuario: {
                      required: true
                    },
                    senha: {
                      required: true
                    }
                },
                errorPlacement: function(erro, elemento) {
                    $("#v"+elemento.attr("id")).html(erro.text());
                },
                success: function(rotulo) {
                    $("#v"+rotulo.attr("id").replace("-error","")).html("");
                }
            });

            $("#btnAcessar").click(function(e){
                e.preventDefault();
                if($("#formularioLogin").valid())
                {                    
                    $.ajax({
                        type: "post",
                        url: "Controller/Acesso/AcessoController.php",
                        data: {"acao":"login", "usuario": $("#usuario").val(), "senha": $("#senha").val() },
                        dataType: "json",
                        success: function(resultado) {
                            if(resultado.sucesso) {
                                location.href=".";
                            }
                            else {
                                console.log(resultado);
                                alert("Falha no login: "+resultado.mensagem)
                            }
                        },
                        error: function(req,erro,msg) {
                            alert("teste");
                            console.log(req);
                            console.log(erro);
                            console.log(msg);
                        }
                    }); 
                }
            });

            $("#senha").keypress(function(e){
                if(e.which == 13) 
                    $("#btnAcessar").click();
            });

        });
    </script>

  </body>
</html>
