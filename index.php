<?php
$controlador=filter_input(INPUT_GET,"controller");
?>
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

        background-color: whitesmoke;        
        color: gray;
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

    </style>
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <?php 
      if(file_exists("View/$controlador/$controlador-head.php"))
        include_once "View/$controlador/$controlador-head.php";
    ?>

  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">
      <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">CNIT</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
        
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuário<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"> <span class="glyphicon glyphicon-user"></span> Perfil  </a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"> <span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                        </ul>
                        </li>
                    </ul>
         
                </div><!--/.navbar-collapse -->
            </div>
      </nav>
        
      <!-- Begin page content -->
      <div class="container">
        <div class="row">
            
            <!--Menu da pagina -->
            <div class="col-sm-3">
                <ul class="list-group">
                    <a class="list-group-item active" style="background: #2f70a8; font-weight: bold;">MENU PRINCIPAL</a>
                    <a class="list-group-item extraActive"><span class="glyphicon glyphicon-home"> </span> Inicial</a>
                    <a class="list-group-item"><span class="glyphicon glyphicon-wrench"></span> Atendimento</a>
                    <a class="list-group-item"><span class="glyphicon glyphicon-phone-alt"></span> Solicitação</a>
                    <a class="list-group-item"><span class="glyphicon glyphicon-user"> </span> Minha Conta</a>
                    <a class="list-group-item"><span class="glyphicon glyphicon-log-out"> </span> Sair</a>            
                </ul>
            </div>
            <!--Fim do menu da página-->
            
            <div class="col-sm-9">            
                <!--Aqui vai o conteúdo da página-->
                
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #2f70a8; color: white; text-align: center; text-transform: uppercase; font-weight: bold">
                        Titulo do panel
                    </div>
                    
                    <?php
                      if(file_exists("View/$controlador/$controlador-body.php"))
                        include_once "View/$controlador/$controlador-body.php";
                    ?>

                    <div class="panel-body">
                        Painel conteudo
                    </div>                    
                </div>
            
            </div>            
            
        </div>      
      </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p>Diretoria de Ensino de São José do Rio Preto. 2018.</p>
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <?php
        if(file_exists("View/$controlador/$controlador-script.php"))
          include_once "View/$controlador/$controlador-script.php";
    ?>

  </body>
</html>
