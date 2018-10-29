var SolicitacaoAtendimentoView = {
    tabela: null,
    addflag: false,
    edflag: false,
    validadorAdicionar: null,
    validadorBuscar: null,
    validadorEditar: null,
    validadorBucarDono: null,
    idSolicitacaoEditada: null,    
    DonoSolicitado: function(modaldiv) {
        SolicitacaoAtendimentoView.validadorBuscarDono.resetForm();
        $("#btnResetarDono").click();
        $("#donoSelecionado").html("");

        $("#formBuscarDono .help-block").html("");
        if(modaldiv == "modalAdicionar" && $("#modalAdicionar").is(":visible"))
        {
            $("#modalAdicionar").modal("hide");
            SolicitacaoAtendimentoView.addflag=true;
        }
        if(modaldiv == "modalEdicao" && $("#modalEdicao").is(":visible"))
        {
            $("#modalEdicao").modal("hide");
            SolicitacaoAtendimentoView.edflag=true;
        }

        $("#modalBuscarDono").modal();
    },
    CarregarSolicitacao: function(idsol) {
        SolicitacaoAtendimentoController.CarregarSolicitacao(
            {idsolicitacao: idsol},
            function(retorno) {
                if(retorno.sucesso)
                {
                    SolicitacaoAtendimentoView.idSolicitacaoEditada=idsol;
                    SolicitacaoAtendimentoView.validadorEditar.resetForm();
                    console.log(retorno);
                                        
                    $("#formEditar .help-block").html("");
                    $("#eddataSolicitacao").val((new Date(retorno.dados.dataAbertura.date)).toLocaleDateString());
                    $("#eddonoAlternativo").val(retorno.dados.idDonoAlternativo);
                    $("#edidnit").val(retorno.dados.idNit);
                    $("#edescola").val(retorno.dados.idEscola);
                    $("#ednomeEntregador").val(retorno.dados.nomeEntregador);
                    $("#eddescricaoProblema").val(retorno.dados.descricaoProblema);
                    $("#modalEdicao").modal("show");
                }
                else
                {
                    alert("Falha na solicitação ao servidor");
                    console.log(retorno);
                }
            },
            function(req,erro,msg) {
                alert("Falha na requisição");
                console.log(req); console.log(erro); console.log(msg);
            }
        );
    },
    InicieComponentes: function()
    {
        SolicitacaoAtendimentoView.tabela=$("#tblSolicitacoes").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

        SolicitacaoAtendimentoView.validadorBuscarDono=criarValidador("#formBuscarDono",
            {
                donoProcurado: {
                    required: true
                }
            }
        );

        SolicitacaoAtendimentoView.validadorEditar=criarValidador("#formEditar",
            {
                eddataSolicitacao: {
                    required: true
                },
                eddonoAlternativo: {
                    require_from_group: [1,".edgrupo"]
                },
                edidnit: {
                    required: true
                },
                edescola: {
                    require_from_group: [1,".edgrupo"]
                },
                ednomeEntregador: {
                    required: true
                },
                eddescricaoProblema: { 
                    required: true
                }
            }
        );
/*
        $(".datepicker").datepicker();
        $(".datepicker").datepicker("setDate",new Date());
*/
        $("#adddataSolicitacao").datepicker();
        $("#adddataSolicitacao").datepicker("setDate",new Date());
        $("#adddataSolicitacao").datepicker({
            changeYear: true,
            onSelect: function(txtdata) {
                SolicitacaoAtendimentoView.validadorAdicionar.element("#adddataSolicitacao");
            }
        });
        $("#adddataSolicitacao").click(function(e){            
            $("#adddataSolicitacao").datepicker("setDate",null);
        });

        $("#dataSolicitacao").datepicker({changeYear: true,
            onSelect: function(txtdata) {                                        
               SolicitacaoAtendimentoView.validadorAdicionar.element("#dataSolicitacao");
            } 
        });

        $("#dataSolicitacao").click(function(e){
            $("#dataSolicitacao").datepicker("setDate",null);
        });

        $("#modalBuscarDono").on("hidden.bs.modal", function() {
            if(SolicitacaoAtendimentoView.addflag)
            {
                SolicitacaoAtendimentoView.addflag=false;            
                $("#modalAdicionar").modal();
            }
            if(SolicitacaoAtendimentoView.edflag)
            {
                SolicitacaoAtendimentoView.edflag=false;
                $("#modalEdicao").modal();
            }
        });

        $("#menuSolicitacao").addClass("extraActive");

        EscolaController.ListarEscolas(
            function(retorno){
                if(retorno.sucesso)
                {
                    var str="";
                    $.each(retorno.dados,function(indice,escola){
                        str+="<option value=\""+escola.idEscola+"\">"+escola.nome+"</option>";
                    });
                    $("#escola").append(str);
                    $("#addescola").append(str);
                    $("#edescola").append(str);
                }   
                else
                    alert("Falha na consulta para preencher escolas");
            },
            function(req,erro,msg){
                alert("Falha ao preencher escolas");
                console.log(req);console.log(erro); console.log(msg);
            }
        );

        SolicitacaoAtendimentoView.validadorAdicionar=criarValidador("#formAdicionar",
            {
                adddataSolicitacao: {
                    required: true
                },
                addidnit: {
                    required: true
                },
                addescola: {
                    /*required: true,*/
                    require_from_group: [1,".aomenosum"]
                },
                adddonoAlternativo: {
                    require_from_group: [1,".aomenosum"]
                },
                addnomeEntregador: {
                    required: true
                },
                adddescricaoProblema: {
                    required: true
                }                
            }
        );

        SolicitacaoAtendimentoView.validadorBuscar=criarValidador("#formBuscar",
            {
                dataSolicitacao: {
                    require_from_group: [1,".nominimoum"]
                },
                escola: {
                    require_from_group: [1,".nominimoum"]
                },
                idnit: {
                    require_from_group: [1,".nominimoum"]
                }
            }
        );

        $("#btnSalvarSolicitacao").click(function(){            
            if($("#formAdicionar").valid()) {
                alert($("#adddescricaoProblema").val());
                SolicitacaoAtendimentoController.AdicionaSolicitacao(
                    {
                        dataabertura: $("#adddataSolicitacao").val(), idnit: $("#addidnit").val(),
                        descricaoproblema: $("#adddescricaoProblema").val(), nomeentregador: $("#addnomeEntregador").val(),
                        idescola: $("#addescola").val(), iddonoalternativo: $("#iddonoalternativo").val()
                    },
                    function(retorno) {
                        if(retorno.sucesso) {
                            alert("Solicitação adicionada com sucesso !");
                            $("#modalAdicionar").modal("hide");
                        }
                        else    
                        {
                            alert("Falha ao cadastrar dados no servidor.");
                            console.log(retorno);
                        }
                    },
                    function(req,erro,msg) {
                        console.log(req); console.log(erro); console.log(msg);
                        alert("Falha no servidor");
                    }
                );
            }
        });

        $("#btnNovo").click(function(e){
            SolicitacaoAtendimentoView.validadorAdicionar.resetForm();
            $("#modalAdicionar .help-block").html("");
            $("#modalAdicionar").modal("show");
        });
        
        $("#dataSolicitacao").click(function(e){

        });

        $("#btnProcurar").click(function(e){
            e.preventDefault();
            if($("#formBuscar").valid()){
                SolicitacaoAtendimentoController.BuscarSolicitacao(
                    {escola:$("#escola").val(),idnit:$("#idnit").val(),dataabertura:$("#dataSolicitacao").val()},
                    function(retorno) {
                        novalinha="";
                        console.log(retorno);
                        if(retorno.sucesso)
                        {
                            SolicitacaoAtendimentoView.tabela.clear().draw();
                            if(!retorno.dados.length)
                                alert("Nenhum valor encontrado !");
                            else
                            {
                                $.each(retorno.dados,function(indice,solicitacao){
                                    novalinha=[(new Date(solicitacao.dataAbertura.date)).toLocaleDateString(), solicitacao.escola, (solicitacao.donoAlternativo == null)?"-----":solicitacao.donoAlternativo, "<button type=\"button\" onclick=\"SolicitacaoAtendimentoView.CarregarSolicitacao("+solicitacao.idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>"];
                                    SolicitacaoAtendimentoView.tabela.row.add(novalinha).draw(false);
                                });
                            }
                        }
                        else
                        {
                            alert("Ocorreram falhas no servidor");
                            console.log(retorno);
                        }

                    },
                    function(req,erro,msg) {
                        console.log(req,erro,msg);
                        alert("Falha na solicitação");
                    }
                );
            }
        });

        $("#btnEditarSalvar").click(function(e){
            e.preventDefault();            
            if($("#formEditar").valid())
            {
                SolicitacaoAtendimentoController.EditarSolicitacao(
                    {idsolicitacao:SolicitacaoAtendimentoView.idSolicitacaoEditada,
                     dataabertura: $("#eddataSolicitacao").val(), iddonoalternativo: $("#eddonoAlternativo").val(),
                     idnit:$("#edidnit").val(),descricaoproblema:$("#eddescricaoProblema").val(),
                     idescola:$("#edescola").val(),nomeentregador:$("#ednomeEntregador").val()
                    },
                    function(retorno) {
                        if(retorno.sucesso)
                        {
                            alert("Dados alterados com sucesso !");
                            $("#modalEdicao").modal("hide");
                            SolicitacaoAtendimentoView.tabela.clear().draw();
                        }
                        else
                        {
                            console.log(retorno);
                            alert("Falha na requisição ao servidor");
                        }
                    },
                    function(req,erro,msg) {
                        alert("Falha na solicitação ao servidor - erro interno");
                        console.log(req); console.log(erro); console.log(msg);
                    }
                );
            }
            else
                alert("Falha na validação");
        });

        $("#btnProcurarDono").click(function(e){
            e.preventDefault();
            if($("#formBuscarDono").valid())
            {
                DonoAlternativoController.BuscarDono(
                    {dono:$("#donoProcurado").val()},
                    function(retorno) {
                        if(retorno.sucesso) {                       
                            $("#donoSelecionado").html("");
    
                            $.each(retorno.dados, function(indice,dados){
                                $("#donoSelecionado").append(" <option value=\""+dados.idDonoAlternativo+"\">"+dados.nome+"</option> ");
                            });
    
                            if(!retorno.dados.length)
                                alert("Nenhum dono encontrado.");
                            console.log(retorno);
                        }
                        else {
                            if(window.console) {
                                console.log(retorno);                            
                            }
                            alert("Falha ao retornar dados do servidor");
                        }
                    },
                    function(req,erro,msg) {
                        if(window.console)  {
                            console.log(req); console.log(erro); console.log(msg);
                        }
                        alert("Falha ao realizar requisição.");
                    }
                );   

            }
        });

        $("#btnListarLivres").click(function(e){
            e.preventDefault();
            novalinha = "";
            SolicitacaoAtendimentoController.BuscaSolicitacoesLivres(
                function(retorno) {
                    if(retorno.sucesso) 
                    {
                        SolicitacaoAtendimentoView.tabela.clear().draw();
                        $.each(retorno.dados,function(indice,solicitacao) {
                            novalinha=[(new Date(solicitacao.dataAbertura.date)).toLocaleDateString(), solicitacao.escola, (solicitacao.donoAlternativo == null)?"-----":solicitacao.donoAlternativo, "<button type=\"button\" onclick=\"SolicitacaoAtendimentoView.CarregarSolicitacao("+solicitacao.idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>"];
                            SolicitacaoAtendimentoView.tabela.row.add(novalinha).draw(false);
                        });

                        if(retorno.dados.length)
                            alert("Carregados "+retorno.dados.length+" solicitações livres");
                        else
                            alert("Nenhum solicitação livre disponível.");
                    }
                    else
                    {
                        if(window.console)
                            console.log(retorno);
                        alert("Não foi possível retornar dados do servidor");
                    }
                },
                function(req,erro,msg) {
                    if(window.console)
                    {
                        console.log(req); console.log(msg); console.log(erro);
                    }
                    alert("Falha na solicitação ao servidor");
                }
            );
        }); 

        $("#btnSelecionarDono").click(function(){
            alert("Teste "+$("#donoSelecionado").val())
        });


    }
};