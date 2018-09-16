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
                        
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input class="form-control" type="text" name="usuario" id="usuario" />
                                <div class="help-block">Mensagem de validação</div>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" />
                                <div class="help-block">Mensagem de validação</div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer" style="text-align: center;" >
                        <button type="button" class="btn btn-success">Acessar</button>
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

    <script>
        $(document).ready(function(){
            $("#modalLogin").modal({backdrop: "static", keyboard: "false"});
        });
    </script>

  </body>
</html>
