var SolicitacaoAtendimentoView = {
    tabela: null,
    addflag: false,
    edflag: false,
    validadorAdicionar: null,
    validadorBuscar: null,
    validadorEditar: null,
    idSolicitacaoEditada: null,    
    DonoSolicitado: function(modaldiv) {
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
                    /*
                    $("#formEditar .help-block").html("");
                    $("#eddataSolicitacao").val((new Date(retorno.dados.dataAbertura.date)).toLocaleDateString());
                    $("#eddonoAlternativo").val(retorno.dados.idDonoAlternativo);
                    $("#edidnit").val(retorno.dados.idnit);
                    $("#edescola").val(retorno.dados.idEscola);
                    $("#ednomeEntregador").val(retorno.dados.nomeEntregador);
                    $("#eddescricaoProblema").val(retorno.dados.descricaoProblema);*/
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

        SolicitacaoAtendimentoView.validadorEditar=criarValidador("#formEditar",
            {
                eddataSolicitacao: {
                    required: true
                },
                eddonoAlternativo: {
                    required: true
                },
                edidnit: {
                    required: true
                },
                edescola: {
                    required: true
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
                alert("Foi válido");
            }
            else    
                alert("É inválido");
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
                SolicitacaoAtendimentoController.BuscaSolicitacao(
                    {escola:$("#escola").val(),idnit:$("#idnit").val(),dataabertura},
                    function(retorno) {
                        novalinha="";
                        if(retorno.sucesso)
                        {
                            SolicitacaoAtendimentoView.tabela.clear().draw();
                            $.each(retorno.dados,function(indice,solicitacao){
                                novalinha=[(new Date(retorno.dados.dataAbertura.date)).toLocaleDateString(), retorno.dados.escola, retorno.dados.dono, "<button type=\"button\" onclick=\"SolicitacaoAtendimentoView.CarregarSolicitacao("+retorno.dados.idSolicitacaoAtendimento+")\"><span class=\"glyphicon glyphicon-pencil\"></span></button>"];
                                SolicitacaoAtendimentoView.tabela.row.add(novalinha).draw(false);
                            });
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
                     idescola:$("#edescola").val()
                    },
                    function(retorno) {
                        if(retorno.sucesso)
                        {
                            alert("Dados alterados com sucesso !");
                            $("#modalEdicao").modal("hide");
                        }
                        else
                        {
                            console.log(retorno);
                            alert("Falha na requisição ao servidor");
                        }
                    },
                    function(req,erro,msg) {

                    }
                );
            }
        });

    }
};