var AtendimentoView = {
    tabela: null,
    validadorBusca: null,
    validadorAdicionar: null,
    validadorEditar: null,
    idEdicaoTecnicoAtual: null,
    idEdicaoSolicitacaoAtual: null,
    InicieComponentes: function(){
        
        AtendimentoView.validadorBusca=criarValidador("#formBuscar",{
            buscaTecnico: {
                require_from_group: [1, ".form-control"]
            },
            buscaIdNit: {
                require_from_group: [1, ".form-control"]
            },
            buscaSituacao: {
                require_from_group: [1, ".form-control"]
            }
        });

        AtendimentoView.tabela=criaDataTable("#tblAtendimentos");

        $("#menuAtendimento").addClass("extraActive");
    
        $("#novaDataInicio").datepicker({changeYear: true,
                                         onSelect: function(txtdata) {                                        
                                            AtendimentoView.validadorAdicionar.element("#novaDataInicio");
                                            AtendimentoView.validadorAdicionar.element("#novaDataFinalizacao");
                                            //console.log("evento disparado");
                                         } 
                                        });
    
        $("#novaDataFinalizacao").datepicker({ changeYear: true,
                                               onSelect: function(txtdata) {
                                                    AtendimentoView.validadorAdicionar.element("#novaDataFinalizacao");
                                                    //console.log("evento disparado dataFinalizacao")
                                               }
        });
    
        $("#editarDataInicio").datepicker({changeYear: true,
                                           onSelect: function(txtdata) {
                                               AtendimentoView.validadorEditar.element("#editarDataInicio");
                                               AtendimentoView.validadorEditar.element("#editarDataFinalizacao");
                                           }
        });

        $("#editarDataFinalizacao").datepicker({changeYear: true,
                                                onSelect: function(txtdata) {
                                                    AtendimentoView.validadorEditar.element("#editarDataFinalizacao");
                                                }
        });


        $("#editarDataFinalizacao").datepicker({changeYear: true});
        $("#novaDataInicio").datepicker("setDate",new Date());
    
        $("#novaDataInicio").click(function(){
            $("#novaDataInicio").datepicker("setDate",null);        
        });
    
        $("#novaDataFinalizacao").click(function(){
            $("#novaDataFinalizacao").datepicker("setDate",null);
        });
        $("#editarDataFinalizacao").click(function(){
            $("#editarDataFinalizacao").datepicker("setDate",null);
        });
    
        AtendimentoController.ListaTecnicos(
            function(retorno) {
                if(retorno.sucesso) {
                    for(x=0;x<retorno.dados.length;x++)
                    {
                        $("#buscaTecnico").append("<option value='"+retorno.dados[x].idTecnico+"'>"+retorno.dados[x].nome+"</option>");
                        $("#novoTecnico").append("<option value='"+retorno.dados[x].idTecnico+"'>"+retorno.dados[x].nome+"</option>");
                        $("#editarTecnico").append("<option value='"+retorno.dados[x].idTecnico+"'>"+retorno.dados[x].nome+"</option>");
                    }
                }
                else {
                    alert("Falha ao preencher select list de tecnicos "+retorno.mensagem)
                }
            },
            function(req,erro,msg) {
                alert("Falha na solicitação ao servidor.");
            }
        );
    
        AtendimentoController.ListaLocalNaDe(
            function(retorno) {
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
            function(req,erro,msg) {
                alert("Falha na solicitação ao servidor");
            }
        );
    
        AtendimentoController.ListaSituacao(
            function(retorno) {
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
            function(req,erro,msg) {
                alert("Falha na solicitação ao servidor");
            }
        );
    
        AtendimentoController.ListaSolicitacaoSemAtendimento(
            function(retorno) {
                if(retorno.sucesso) {
                    for(x=0;x<retorno.dados.length;x++)
                        $("#novaSolicitacaoAtendimento").append("<option value='"+retorno.dados[x].idSolicitacaoAtendimento+"'>"+(new Date(retorno.dados[x].dataAbertura.date)).toLocaleDateString()+" - "+retorno.dados[x].idNit+", "+retorno.dados[x].descricaoProblema+"</option>");
                }
                else {
                    alert("Ocorreu um erro ao consultar o servidor: "+retorno.mensagem);                
                }
            },
            function(req,erro,msg) {
    
            }
        );
    
        $("#btnProcurar").click(function(e){
            e.preventDefault(); 
            AtendimentoView.validadorBusca.resetForm()         
            /*if($("#buscaTecnico").val().length == 0 && $("#buscaIdNit").val().length == 0 && $("#buscaSituacao").val().length == 0)    
                $("#vbuscaTecnico").html("Escolha ao menos um valor");
            else*/
            if($("#formBuscar").valid())
            {
                $("#vbuscaTecnico").html("");
                AtendimentoController.BuscaAtendimento(
                    {"idtecnico" : $("#buscaTecnico").val(), "idnit": $("#buscaIdNit").val(), "idsituacao" : $("#buscaSituacao").val() },
                    function(retorno) {
                        //alert("aqui");
                        //console.log(retorno);
                        if(retorno.sucesso) {
                            AtendimentoView.tabela.clear().draw();                        
                            if(!retorno.dados.length)
                                alert("Nenhum registro encontrado");
                            /*"<button type=\"button\" class=\"btn btn-sm\" onclick=\"javascript:AtendimentoView.CarregarAtendimento("+retorno.dados[x].idTecnico+","+retorno.dados[x].idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>" ]*/
                            for(x=0;x<retorno.dados.length;x++)                                                        
                                AtendimentoView.tabela.row.add([ retorno.dados[x].escolaNome, retorno.dados[x].idNit, retorno.dados[x].tecnicoNome, retorno.dados[x].situacao, "<button type=\"button\" class=\"btn btn-sm\" onclick=\"javascript:AtendimentoView.CarregarAtendimento("+retorno.dados[x].idTecnico+","+retorno.dados[x].idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>"]).draw(false);
                        }                    
                        else {
                            alert("Não foi possível consultar informações: "+retorno.mensagem);
                        }
                    },
                    function(req,erro,msg) {
                        console.log(req,erro,msg);
                        alert("Falha na solicitação ao servidor");
                    }
                );
            }
        });
    
        $.validator.addMethod("dataFim", function (valor,elemento,parametros){
            var dataFinalPartes,dataInicialPartes,dataFinal,dataInicial;
            
            if(parametros.dataFim.dataInicial != null && $(parametros.dataFim.dataInicial).val() != "" &&
                elemento != null && $(elemento).val() != "")
            {
                //console.log("passow");                
                dataFinalPartes=valor.split("/");
                dataInicialPartes=$(parametros.dataFim.dataInicial).val().split("/");      
                
                
                if(dataFinalPartes.length != 3 || dataInicialPartes.length != 3)
                {
                    alert("ok ");
                    return false;
                }

                    
    
                dataFinal=new Date(dataFinalPartes[2],dataFinalPartes[1]-1,dataFinalPartes[0]);
                dataInicial=new Date(dataInicialPartes[2],dataInicialPartes[1]-1,dataInicialPartes[0]);
    
                /*console.log(dataFinalPartes[0]+" "+dataFinalPartes[1]+" "+dataFinalPartes[2]);
                console.log(dataInicialPartes[0]+" "+dataInicialPartes[1]+" "+dataInicialPartes[2]);*/
    
                return !(dataFinal.getTime()<dataInicial.getTime());
            }
            else
                return true;        
        },"Data final menor que a inicial");
    
    
        AtendimentoView.validadorAdicionar=criarValidador("#formAdicionar",
            {
                novoTecnico: {
                    required: true
                },
                novaSolicitacaoAtendimento: {
                    required: true
                },
                novoLocalDE: {
                    required: true
                },
                novaSituacao: {
                    required: true
                },
                novaDataInicio: {
                    required: true
                },
                novaDataInicio: {
                    required: true
                },
                novaDataFinalizacao: {
                    dataFim: { dataFim: { dataInicial: "#novaDataInicio" } }
                },
                novaDescricaoSolucao: {
                    required: true
                }
            }
        ); 
    
        $("#btnAdicionarAtendimento").click(function(e){
            e.preventDefault();            
            if($("#formAdicionar").valid())
            {
                AtendimentoController.AdicionarAtendimento(
                    {
                        novoTecnico: $("#novoTecnico").val(), novaSolicitacaoAtendimento: $("#novaSolicitacaoAtendimento").val(),
                        novoLocalDE: $("#novoLocalDE").val(), novaSituacao: $("#novaSituacao").val(), novaDataInicio: $("#novaDataInicio").val(),
                        novaDataFinalizacao: $("#novaDataFinalizacao").val(), novaDescricaoSolucao: $("#novaDescricaoSolucao").val()
                    },
                    function(retorno) {
                        console.log(retorno);
                        if(retorno.sucesso) {
                            alert("Novo atendimento adicionado com sucesso !");
                            $("#formAdicionar").reset();
                            AtendimentoView.validadorAdicionar.resetForm();
                        }
                        else {
                            alert("Falha ao adicionar novo atendimento");                        
                        }
                    },
                    function(req,erro,msg){
                        console.log(req,erro,msg);
                        alert("Falha na solictação ao servidor");
                    }
                );
            }
            else   
                alert("Ocorreram erros de validação");
        });

        $("#btnNovo").click(function(e){
            e.preventDefault();
            $("#formAdicionar .help-block").html("");
            AtendimentoView.validadorAdicionar.resetForm();
            $("#modalAdicionar").modal();            
            /*
            AtendimentoController.QuantidadeSolicitacaoLivre(
                function(retorno)  {                               
                    $("#modalAdicionar").modal();
                },
                function(req,erro,msg) {
                    console.log(req); console.log(erro); console.log(msg);
                    alert("Falha na solicitação ao servidor");
                }
            );*/
        });

        /****
         * TODO - Botão de Editar Atendimento
         * Chamar função de AtendimentoController.AlterarAtendimento()
         */
        AtendimentoView.validadorEditar=criarValidador("#formEditarAtendimento",
            {
                editarLocalDE: {
                    required: true
                },
                editarSituacao: {
                    required: true
                }, 
                editarDataInicio: {
                    required: true
                },
                editarDataFinalizacao: {
                    dataFim: { dataFim: { dataInicial: "#editarDataInicio" }   }
                },
                editarDescricaoSolucao: {
                    required: true
                }
            } 
        );

        $("#btnEditarAtendimento").click(function(e){
            e.preventDefault();   
            console.log(AtendimentoView.validadorEditar);
            //alert("teste");
            if($("#formEditarAtendimento").valid())
            {
                
            }
            else
                alert("Form inválido");
        });

    },
    CarregarAtendimento: function(idTecnico,idSolicitacao) {
        AtendimentoController.CarregarAtendimento(
            {"idtecnico":idTecnico,"idsolicitacao":idSolicitacao},
            function(retorno) {                
                console.log(retorno);
                if(retorno.sucesso) {
                    AtendimentoView.idEdicaoSolicitacaoAtual=idSolicitacao;
                    AtendimentoView.idEdicaoTecnicoAtual=idTecnico;

                    $("#btnEditarReset").click();
                    AtendimentoView.validadorEditar.resetForm();
                    $("#formEditarAtendimento .help-block").html("");
        
                    /*
                    $("#btnEditarReset").click();
                    AtendimentoView.validadorEditar.resetForm();*/

                    $("#editarTecnico").val(retorno.dados.idTecnico);
                    document.getElementById("editarSolicitacaoAtendimento").value=retorno.dados.idSolicitacaoAtendimento;
                    $("#editarLocalDE").val(retorno.dados.idLocalNaDe);
                    $("#editarSituacao").val(retorno.dados.idSituacao);
                    $("#editarDataInicio").val((new Date(retorno.dados.dataInicio.date)).toLocaleDateString());
                    if(retorno.dataFinalizado)
                        $("#editarDataFinalizacao").val( (new Date(retorno.dados.dataFinalizado.date)).toLocaleDateString() );
                    $("#editarDescricaoSolucao").val(retorno.dados.descricaoSolucao);

                    $("#modalEditar").modal();
                }
                else
                    alert("Falha ao retornar dados do servidor "+retorno.mensagem);
            },
            function(req,erro,msg) {
                alert("Falha na solicitação");
                console.log(req); console.log(erro); console.log(msg);
            }
        );
    }
}